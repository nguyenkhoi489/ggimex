<?php

use App\Jobs\SendGoogleSheets;
use App\Models\ChatWidget;
use App\Models\Comments;
use App\Models\Contacts;
use App\Models\Menus;
use App\Models\PostCategories;
use App\Models\Posts;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\RedirectRoles;
use App\Models\Script;
use App\Models\Slider;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {

    /** API Client User **/

    //Submit Comment
    Route::post('comment', function (Request $request) {
        $data = ['name' => $request->name, 'email' => $request->email, 'rating' => $request->rating ?? null, 'message' => $request->message, 'product_id' => $request->product_id, 'type' => strpos($request->slug, '/product/') !== false ? 1 : 0, 'ip_address' => $_SERVER['REMOTE_ADDR']];
        $comment = Comments::create($data);
        if ($comment) {
            return response()->json(['success' => true, 'message' => 'Your comment is awaiting moderation.']);
        }
        return response()->json(['success' => false, 'message' => 'An error occurred, please contact the administrator']);
    })->name('post.comment');

    //Submit Form Product
    Route::post('submit-form', function (Request $request) {
        $url_script = 'https://script.google.com/macros/s/AKfycbzvPK127Tr2jiE63-KPgq7y_PgzUGrPCCmITzPAXUaTQ-Q6eF_Dk3TBUBTpF6cxKhOy/exec';
        $product = Product::find($request->product_id);
        $data_query = ['URL' => url('/product/' . $product->slug), 'PRODUCT_NAME' => $product->title, 'USER_NAME' => $request->name, 'USER_EMAIL' => $request->email, 'USER_PHONE' => $request->phone, 'USER_MESSAGE' => $request->message];
        $data = ['title' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'message' => $request->message, 'link' => url('/product/' . $product->slug),];
        $contact = Contacts::create($data);
        $jobs = new SendGoogleSheets($url_script . "?" . http_build_query($data_query));
        dispatch($jobs)->delay(now()->addSeconds(20));
        $data_mail = [
            'subject' => 'Thông tin liên hệ',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'link' => url('/product/' . $product->slug)
        ];
        $jobs_mail = new \App\Jobs\SendMailForm($data_mail);
        dispatch($jobs_mail)->delay(now()->addSeconds(25));
        if ($contact) {
            return response()->json(['success' => true, 'message' => 'Sending data successfully']);
        }

//        dispatch($jobs_mail)->delay(now()->addSeconds(20));
        return response()->json(['success' => false, 'message' => 'An error occurred, please contact the administrator']);
    })->name('form.submit');

    //Product
    Route::post('get-product', function (Request $request) {
        $price_min = $request->price_min;
        $price_max = $request->price_max;
        $sort_by = $request->sort_by;
        $category = $request->category;
        $tags = $request->tags;

        $product = Product::select('product.*', 'prefix.value')->whereBetween('product.price', [$price_min, $price_max])
            ->join('prefix', function ($join) {
                $join->on('prefix.id', '=', 'product.prefix_id');
            })
            ->when($category, function ($query, $category) {
                if ($category) return $query->where('product.categories_id', $category);
            })->when($sort_by, function ($query, $sort_by) {
                switch ($sort_by) {
                    case 6:
                        return $query->orderby('product.sku', 'desc');
                        break;
                    case 5:
                        return $query->orderby('product.sku', 'asc');
                        break;
                    case 4:
                        return $query->orderby('product.title', 'desc');
                        break;
                    case 3:
                        return $query->orderby('product.title', 'asc');
                        break;
                    case 2:
                        return $query->orderby('product.price', 'desc');
                        break;
                    case 1:
                        return $query->orderby('product.price', 'asc');
                        break;
                    case 0:
                        return $query->latest();
                        break;
                }
            })->take(18)->get();
        if ($tags != 0)
        {
            $product_tags = \App\Models\ProductTags::find($tags);
            $product = Product::where('id',$product_tags->product_id)
                ->when($category, function ($query, $category) {
                    if ($category) return $query->where('categories_id', $category);
                })->when($sort_by, function ($query, $sort_by) {
                    switch ($sort_by) {
                        case 6:
                            return $query->orderby('sku', 'desc');
                            break;
                        case 5:
                            return $query->orderby('sku', 'asc');
                            break;
                        case 4:
                            return $query->orderby('title', 'desc');
                            break;
                        case 3:
                            return $query->orderby('title', 'asc');
                            break;
                        case 2:
                            return $query->orderby('price', 'desc');
                            break;
                        case 1:
                            return $query->orderby('price', 'asc');
                            break;
                        case 0:
                            return $query->latest();
                            break;
                    }
                })->take(18)->get();
        }

        return response()->json(['success' => true,'data' => $product],200);
    })->name('get.product');

    /** API Administrator **/
    Route::middleware('admin.verify')->group(function (){
        //Create Slug
        Route::post('create-slug', function (Request $request) {
            return Str::slug($request->title);
        })->name('slug.create');

        //Get Post Category
        Route::get('get-post-category', function () {
            $categories = PostCategories::select('id', 'title')->orderby('title', 'asc')->get();
            return response()->json(['success' => true, 'categories' => $categories]);
        })->name('get.post.category');

        //Get product Category
        Route::get('get-product-category', function () {
            $categories = ProductCategories::select('id', 'title')->orderby('title', 'asc')->get();
            return response()->json(['success' => true, 'categories' => $categories]);
        })->name('get.product.category');

        //Filter sub-folder
        Route::post('filter-folder',function (Request $request){
            $base = "public/";
            $folder = null;
            if (isset($request->year))
            {
                $folder = $base . $request->year;
            }
            if (isset($request->year) && isset($request->month))
            {
                $folder = $base . $request->year . '/' . $request->month;
            }
            $sub_folder = (new App\Helper\Helper())->filter_folder($folder);
            return response()->json(['succes' => true,'data' => $sub_folder]);
        })->name('get.folder');

        //get media by filer
        Route::post('get-filter-media',function (Request $request){
            $base = "public";
            $folder = null;

            if (isset($request->year) && $request->year != 0)
            {
                $folder = $base . '/' . $request->year;
            }
            if (isset($request->year) && $request->year != 0 && isset($request->month) && $request->month != 0)
            {
                $folder = $base . '/' . $request->year . '/' . $request->month;
            }
            if (isset($request->year) && $request->year != 0 && isset($request->month) && $request->month != 0 && isset($request->day) && $request->day != 0 )
            {
                $folder = $base . '/' . $request->year . '/' . $request->month . '/' . $request->day;
            }

            $list_files = Storage::allFiles($folder);
            $images = [];
            foreach ($list_files as $item) {
                if (in_array(Storage::mimeType($item),['image/jpeg', 'image/png', 'image/webp'])) {
                    $images[] = str_replace('public','storage',$item);
                }
            }

            $files = array_slice(array_reverse($images),0,20);
            return response()->json(['success' => true , 'data' => $files]);
        })->name('get.media');

        //remove media
        Route::post('remove-media',function (Request $request){
            $files = $request->input('files');
            if (count($files) > 0)
            {
                foreach ($files as $item)
                {
                    $file = str_replace('storage','public',$item);
                    if (Storage::fileExists($file))
                    {

                        Storage::delete($file);
                    }
                }
            }
            return response()->json(['success' => true ] );
        })->name('remove.media');

        //change menu
        Route::post('change-menus',function (Request $request){
            $type = $request->input('type');
            $id = $request->input('id');
            $res = null;
            switch ($type){
                case 1:
                    foreach (array_values($id) as $item)
                    {
                        $key = key($item);
                        $menus = Menus::find($key);
                        if ($menus) {
                            $menus->sort_by = $item[$key];
                            $menus->save();
                        }
                    }
                    break;
                case 2:
                    Menus::whereIn('id',$id)->update(['is_active' => 0]);

                    break;
                case 3:
                    Menus::whereIn('id',$id)->update(['is_active' => 1]);

                    break;
            }
            return response()->json(['success' => true]);

        })->name('api.menu.update');

        Route::post('change-all',function (Request $request){
            $id = $request->input('id');
            $type = $request->input('type');
            $table = $request->input('table');
            $model = null;
            switch ($table){
                case 1:
                    $model = Product::whereIn('id',$id)->get();
                    break;
                case 2:
                    $model = Posts::whereIn('id',$id)->get();
                    break;
                case 3:
                    $model = PostCategories::whereIn('id',$id)->get();
                    break;
                case 4:
                    $model = ProductCategories::whereIn('id',$id)->get();
                    break;
                case 5:
                    $model = ChatWidget::whereIn('id',$id)->get();
                    break;
                case 6:
                    $model = Comments::whereIn('id',$id)->get();
                    break;
                case 7:
                    $model = Script::whereIn('id',$id)->get();
                    break;
                case 8:
                    $model = Slider::whereIn('id',$id)->get();
                    break;
                case 9:
                    $model = Social::whereIn('id',$id)->get();
                    break;
                case 10:
                    $model = RedirectRoles::whereIn('id',$id)->get();
                    break;
                case 11:
                    $model = User::whereIn('id',$id)->get();
                    break;
            }
            switch ($type){
                case 1:
                    foreach ($model as $item)
                    {
                        $item->is_active = 0;
                        $item->save();
                    }
                    break;
                case 2:
                    foreach ($model as $item)
                    {
                        $item->is_active = 1;
                        $item->save();
                    }
                    break;
                case 3:
                    foreach ($model as $item)
                    {
                        $item->is_active = 1;
                        $item->delete();
                    }
                    break;
            }
            return response()->json(['success' => true]);
        })->name('api.product.update');
    });


});