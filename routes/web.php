<?php

use App\Http\Controllers\admin\ChatWidgetController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\admin\MediaController;
use App\Http\Controllers\admin\MenusController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\PostCategoriesController;
use App\Http\Controllers\admin\PostsController;
use App\Http\Controllers\admin\PrefixController;
use App\Http\Controllers\admin\ProductCategoriesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RedirectController;
use App\Http\Controllers\admin\ScriptController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\SmtpController;
use App\Http\Controllers\admin\SocialController;
use App\Http\Controllers\admin\user\LoginController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\MainController as ClientController;
use App\Jobs\ClearCache;
use App\Models\Comments;
use App\Models\PostCategories;
use App\Models\Posts;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductTags;
use App\Models\RedirectRoles;
use App\Models\Seo;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$redirects = RedirectRoles::where('is_active', 1)->get();

foreach ($redirects as $link) {
    if (URL::current() == URL::to($link->old_url)) {
        return Redirect::to($link->new_url, $link->type)->send();
    }
}

Route::get('/', [ClientController::class, 'index'])->name('home');

//admin
Route::prefix('administrator')->group(function () {
    Route::middleware('isLogin')->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('login', 'index')->name('login.index');
            Route::post('login', 'store')->name('login.store');
        });
    });
    Route::middleware('auth')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('dashboard'); // Main Admin
        //Setting Website
        Route::controller(SettingsController::class)->group(function () {
            Route::get('cau-hinh-website', 'index')->name('setting.index');
            Route::put('cau-hinh-website', 'update')->name('setting.update');
        });
        Route::get('logout', [MainController::class, 'destroy'])->name('logout'); // Đăng xuất
        Route::get('clear-cache', function () {
            $jobs = new ClearCache();
            dispatch($jobs)->delay(now()->addSeconds(2));
            Artisan::call("cache:clear");
            return back()->with('success', 'Xoá cache thành công!');
            // return redirect()->route('dashboard');
        })->name('cache.clear'); // Remove cache
        Route::get('cache',function(){
            $cache = Artisan::call("cache:clear");
        })->name('cache.route.clear'); // Remove cache
        //Cau hinh smtp
        Route::controller(SmtpController::class)->group(function () {
            Route::get('cau-hinh-smtp', 'index')->name('smtp.index');
            Route::put('cau-hinh-smtp', 'update')->name('smtp.update');
        });
        //Media
        Route::controller(MediaController::class)->group(function () {
            Route::get('danh-sach-media', 'index')->name('media.index');
            Route::post('search-media', 'showAllMedia')->name('media.search');
            Route::post('upload-image', 'store')->name('media.store');
            Route::post('upload-media', 'show')->name('media.ckeditor');
            Route::delete('remove-image', 'destroy')->name('media.destroy');
        });
        //Post Categories
        Route::controller(PostCategoriesController::class)->group(function () {
            Route::get('danh-sach-danh-muc', 'index')->name('categories.index');
            Route::get('them-danh-muc', 'create')->name('categories.create');
            Route::post('them-danh-muc', 'store')->name('categories.store');
            Route::get('chinh-sua-danh-muc/{id}', 'edit')->name('categories.edit');
            Route::put('chinh-sua-danh-muc/{id}', 'update')->name('categories.update');
            Route::delete('xoa-danh-muc/{id}', 'destroy')->name('categories.destroy');
        });
        //Posts
        Route::controller(PostsController::class)->group(function () {
            Route::get('danh-sach-bai-viet', 'index')->name('posts.index');
            Route::get('them-bai-viet', 'create')->name('posts.create');
            Route::post('them-bai-viet', 'store')->name('posts.store');
            Route::get('chinh-sua-bai-viet/{id}', 'edit')->name('posts.edit');
            Route::put('chinh-sua-bai-viet/{id}', 'update')->name('posts.update');
            Route::delete('xoa-bai-viet/{id}', 'destroy')->name('posts.destroy');
        });
        //ChatWidget
        Route::controller(ChatWidgetcontroller::class)->group(function () {
            Route::get('danh-sach-chatwidget', 'index')->name('chatwidget.index');
            Route::get('them-chatwidget', 'create')->name('chatwidget.create');
            Route::post('them-chatwidget', 'store')->name('chatwidget.store');
            Route::get('chinh-sua-chatwidget/{id}', 'edit')->name('chatwidget.edit');
            Route::put('chinh-sua-chatwidget/{id}', 'update')->name('chatwidget.update');
            Route::delete('remove-chatwidget/{id}', 'destroy')->name('chatwidget.destroy');
        });
        //Slider
        Route::controller(SliderController::class)->group(function () {
            Route::get('danh-sach-slider', 'index')->name('slider.index');
            Route::get('them-slider', 'create')->name('slider.create');
            Route::post('them-slider', 'store')->name('slider.store');
            Route::get('chinh-sua-slider/{id}', 'edit')->name('slider.edit');
            Route::put('chinh-sua-slider/{id}', 'update')->name('slider.update');
            Route::delete('remove-slider/{id}', 'destroy')->name('slider.destroy');
        });
        //Social
        Route::controller(SocialController::class)->group(function () {
            Route::get('danh-sach-social', 'index')->name('social.index');
            Route::get('them-social', 'create')->name('social.create');
            Route::post('them-social', 'store')->name('social.store');
            Route::get('chinh-sua-social/{id}', 'edit')->name('social.edit');
            Route::put('chinh-sua-social/{id}', 'update')->name('social.update');
            Route::delete('remove-social/{id}', 'destroy')->name('social.destroy');
        });
        //Product Categories
        Route::controller(ProductCategoriesController::class)->group(function () {
            Route::get('danh-muc-san-pham', 'index')->name('product.categories.index');
            Route::get('them-danh-muc-san-pham', 'create')->name('product.categories.create');
            Route::post('them-danh-muc-san-pham', 'store')->name('product.categories.store');
            Route::get('chinh-sua-danh-muc-san-pham/{id}', 'edit')->name('product.categories.edit');
            Route::put('chinh-sua-danh-muc-san-pham/{id}', 'update')->name('product.categories.update');
            Route::delete('remove-danh-muc-san-pham/{id}', 'destroy')->name('product.categories.destroy');
        });
        //Product Prefix
        Route::controller(PrefixController::class)->group(function () {
            Route::get('danh-sach-tien-te', 'index')->name('prefix.index');
            Route::get('them-loai-tien-te', 'create')->name('prefix.create');
            Route::post('them-loai-tien-te', 'store')->name('prefix.store');
            Route::get('chinh-sua-loai-tien-te/{id}', 'edit')->name('prefix.edit');
            Route::put('chinh-sua-loai-tien-te/{id}', 'update')->name('prefix.update');
            Route::delete('remove-loai-tien-te/{id}', 'destroy')->name('prefix.destroy');
        });
        //Product
        Route::controller(ProductController::class)->group(function () {
            Route::get('danh-sach-san-pham', 'index')->name('product.index');
            Route::get('them-san-pham', 'create')->name('product.create');
            Route::post('them-san-pham', 'store')->name('product.store');
            Route::get('chinh-sua-san-pham/{id}', 'edit')->name('product.edit');
            Route::put('chinh-sua-san-pham/{id}', 'update')->name('product.update');
            Route::delete('remove-san-pham/{id}', 'destroy')->name('product.destroy');
        });
        //Script
        Route::controller(ScriptController::class)->group(function () {
            Route::get('danh-sach-script', 'index')->name('script.index');
            Route::get('them-script', 'create')->name('script.create');
            Route::post('them-script', 'store')->name('script.store');
            Route::get('chinh-sua-script/{id}', 'edit')->name('script.edit');
            Route::put('chinh-sua-script/{id}', 'update')->name('script.update');
            Route::delete('remove-script/{id}', 'destroy')->name('script.destroy');
        });
        //Redirect Roles
        Route::controller(RedirectController::class)->group(function () {
            Route::get('danh-sach-link', 'index')->name('redirect.index');
            Route::get('them-link', 'create')->name('redirect.create');
            Route::post('them-link', 'store')->name('redirect.store');
            Route::get('chinh-sua-link/{id}', 'edit')->name('redirect.edit');
            Route::put('chinh-sua-link/{id}', 'update')->name('redirect.update');
            Route::delete('remove-link/{id}', 'destroy')->name('redirect.destroy');
        });
        //Menus Controller
        Route::controller(MenusController::class)->group(function () {
            Route::get('danh-sach-menu', 'index')->name('menus.index');
            Route::get('them-menu', 'create')->name('menus.create');
            Route::post('them-menu', 'store')->name('menus.store');
            Route::get('chinh-sua-menu/{id}', 'edit')->name('menus.edit');
            Route::put('chinh-sua-menu/{id}', 'update')->name('menus.update');
            Route::delete('remove-menu/{id}', 'destroy')->name('menus.destroy');
        });
        //Pages Controller
        Route::controller(PagesController::class)->group(function () {
            Route::get('danh-sach-pages', 'index')->name('pages.index');
            Route::get('them-pages', 'create')->name('pages.create');
            Route::post('them-pages', 'store')->name('pages.store');
            Route::get('chinh-sua-pages/{id}', 'edit')->name('pages.edit');
            Route::put('chinh-sua-pages/{id}', 'update')->name('pages.update');
            Route::delete('remove-pages/{id}', 'destroy')->name('pages.destroy');
        });
        //Comment
        Route::controller(CommentController::class)->group(function () {
            Route::get('danh-sach-danh-gia', 'index')->name('comment.index');
            Route::get('chinh-sua-danh-gia/{id}', 'edit')->name('comment.edit');
            Route::put('chinh-sua-danh-gia/{id}', 'update')->name('comment.update');
            Route::delete('remove-danh-gia/{id}', 'destroy')->name('comment.destroy');
        });
        //Form
        Route::controller(ContactController::class)->group(function () {
            Route::get('danh-sach-lien-he', 'index')->name('contact.index');
            Route::get('xem-chi-tiet-lien-he/{id}', 'edit')->name('contact.edit');
            Route::delete('remove-lien-he/{id}', 'destroy')->name('contact.destroy');
        });

        //Danh sach quan tri vien
        Route::controller(UserController::class)->group(function () {
            Route::get('danh-sach-quan-tri-vien', 'index')->name('admin.index');
            Route::get('them-quan-tri-vien', 'create')->name('admin.create');
            Route::post('them-quan-tri-vien', 'store')->name('admin.store');
            Route::get('chinh-sua-quan-tri-vien/{id}', 'edit')->name('admin.edit');
            Route::put('chinh-sua-quan-tri-vien/{id}', 'update')->name('admin.update');
            Route::delete('remove-quan-tri-vein/{id}', 'destroy')->name('admin.destroy');
        });
    });

});

Route::middleware('Counter')->group(function () {
    //Product - Cache
    Route::get('product/{slug}', function ($slug = '') {
        return Cache::remember('product-category-slug__' . $slug, 3600, function () use ($slug) {
            $seo = Seo::where('type', 'Product')->where('slug', $slug)->first();
            if (!$seo) return abort(404);
            $product = Product::select('product.*', 'product_categories.slug as categories_slug', 'product_categories.title as categories_title', 'prefix.value')->where('product.id', $seo->posts_id)->join('product_categories', function ($join) {
                $join->on('product_categories.id', '=', 'product.categories_id');
            })->join('prefix', function ($join) {
                $join->on('prefix.id', '=', 'product.prefix_id');
            })->first();

            return view('pages.product', ['title' => $product->title, 'product' => $product, 'seo' => $seo, 'pre_product' => Product::where('id', $seo->posts_id - 1)->select('slug')->first(), 'next_product' => Product::where('id', $seo->posts_id + 1)->select('slug')->first(), 'tags' => ProductTags::select('title', 'slug')->where('product_id', $product->id)->get(), 'reviews' => Comments::select('name', 'message', 'created_at')->where('is_active', 1)->where('type', 1)->where('product_id', $product->id)->get(), 'related' => Product::select('product.title', 'product.slug', 'product.thumb', 'product.price', 'product.price_to', 'prefix.value')->where('product.categories_id', $product->categories_id)->where('product.is_active', 1)->whereNotIn('product.id', [$product->id])->join('prefix', function ($join) {
                $join->on('prefix.id', '=', 'product.prefix_id');
            })->get()])->render();
        });
    });

//Product Category - Cache
    Route::get('product-category/{slug}', function ($slug = '') {

        return Cache::remember('product-category-slug__' . $slug, 3600, function () use ($slug) {
            $seo = Seo::where('type', 'ProductCategories')->where('slug', $slug)->first();
            if (!$seo) return abort(404);
            $category = ProductCategories::where('id', $seo->posts_id)->first();
            $product = Product::select('product.*', 'prefix.value')->where('product.is_active', 1)->where('product.categories_id', $category->id)->join('prefix', function ($join) {
                $join->on('prefix.id', '=', 'product.prefix_id');
            })->paginate(18);

            return view('pages.product_category', ['title' => $category->title, 'products' => $product, 'seo' => $seo,])->render();
        });

    });

//Product Tags - Cache
    Route::get('product-tag/{slug}', function ($slug = '') {

        return Cache::remember('product-tag-slug__' . $slug, 3600, function () use ($slug) {
            $tags = ProductTags::select('title', 'product_id')->where('slug', $slug)->first();
            if (!$tags) return abort(404);
            $product = Product::select('product.*', 'prefix.value')->where('product.is_active', 1)->where('product.id', $tags->product_id)->join('prefix', function ($join) {
                $join->on('prefix.id', '=', 'product.prefix_id');
            })->paginate(18);
            return view('pages.product_tag', ['title' => $tags->title, 'products' => $product,])->render();
        });

    });

//Post category - Cache
    Route::get('category/{slug}', function ($slug = '') {

        return Cache::remember('post-category-slug__' . $slug, 3600, function () use ($slug) {
            $seo = Seo::where('type', 'PostCategories')->where('slug', $slug)->first();
            if (!$seo) return abort(404);
            $posts = Posts::select('posts.*', 'post_categories.title as category_name', 'post_categories.slug as category_link')->where('posts.is_active', 1)->where('posts.categories_id', $seo->posts_id)->join('post_categories', function ($join) {
                $join->on('post_categories.id', '=', 'posts.categories_id');
            })->paginate(15);

            return view('pages.category', ['title' => $seo->title, 'seo' => $seo, 'posts' => $posts])->render();
        });

    });

//Shop pages - Cache
    Route::get('all-product', function () {
        $product = null;
        if (Cache::has('product')) {
            $product = Cache::get('product');
        } else {
            $product = Product::select('product.*', 'prefix.value')->where('product.is_active', 1)->join('prefix', function ($join) {
                $join->on('prefix.id', '=', 'product.prefix_id');
            })->paginate(18);
            Cache::set('product', $product);
        }
        $product_category = null;
        if (Cache::has('product_category')) {
            $product_category = Cache::get('product_category');
        } else {
            $product_category = ProductCategories::where('is_active', 1)->orderby('title', 'asc')->get();
            Cache::set('product_category', $product_category);
        }
        return view('pages.shop', ['title' => 'All Product', 'products' => $product, 'categories' => $product_category]);
    })->name('shop');

//Blogs pages - Cache
    Route::get('news', function () {
        $posts = null;
        if (Cache::has('posts')) {
            $posts = Cache::get('posts');
        } else {
            $posts = Posts::select('posts.*', 'post_categories.title as category_name', 'post_categories.slug as category_link')->where('posts.is_active', 1)->join('post_categories', function ($join) {
                $join->on('post_categories.id', '=', 'posts.categories_id');
            })->paginate(15);
            Cache::set('posts', $posts);
        }
        $categories = null;
        if (Cache::has('categories')) {
            $categories = Cache::get('categories');
        } else {
            $categories = PostCategories::select('slug', 'title')->where('is_active', 1)->orderby('title', 'asc')->get();
            Cache::set('categories', $categories);
        }

        return view('pages.blogs', ['title' => 'News', 'posts' => $posts, 'categories' => $categories]);
    })->name('category');

//Contact us - Cache
    Route::get('contact-us', function () {
        return view('pages.contact', ['title' => 'Contact Us', 'post' => (object)['thumb' => 'storage/2023/12/27/170366384620fc506e698f9ed1c79e-1-1-2048x1419.jpg', 'title' => 'Contact Us']]);
    })->name('contact');
    //Search
    Route::get('search', function () {
        $keyword = \request()->input('keyword');
        $product = null;
        $post = null;
        if ($keyword) {
            $product = Product::where('title', 'LIKE', "%$keyword%")->where('is_active', 1)->get();
            $post = Posts::where('title', 'LIKE', "%$keyword%")->where('is_active', 1)->get();
        }
        return view('search',[
            'title' => 'Search Results for ' . $keyword,
            'product' => $product,
            'post' => $post
        ]);
    })->name('search.keyword');
    //Post - cache
    Route::get('{slug}', function ($slug) {

        return Cache::remember('post-slug__' . $slug, 3600, function () use ($slug) {
            $seo = Seo::where('slug', $slug)->first();

            if (!$seo) return abort(404);

            $model = $seo->getModel();

            return view($model->getView(), ['title' => $model->title, 'seo' => $seo, 'post' => $model])->render();
        });

    });
});
