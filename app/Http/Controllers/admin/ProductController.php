<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductTagsRequest;
use App\Http\Requests\SeoRequest;
use App\Models\Prefix;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductTags;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $category_id = \request()->input('category');
        $status = \request()->input('is_active');
        $title = \request()->input('title');

        return view('admin.product.index',[
            'title' => 'Danh sách sản phẩm',
            'products' => Product::select('product.id','product.title','product.price','product.price_type','product.price_to','product.sku','product.inventory','product.is_active','product.created_at','product_categories.title as categories_name','prefix.value')
                ->when($category_id != 0,function ($query) use ($category_id){
                    $query->where('product.categories_id',$category_id);
                })
                ->when($status !== "all" && $status !== null,function ($query) use ($status){
                    $query->where('product.is_active',$status);
                })
                ->when($title != null,function ($query) use ($title){
                    $query->where('product.title','LIKE',"%{$title}%");
                })
                ->join('product_categories',function ($join){
                    $join->on('product_categories.id','=','product.categories_id');
                })
                ->join('prefix',function ($join){
                    $join->on('prefix.id','=','product.prefix_id');
                })
                ->paginate(15),
            'category' => ProductCategories::select('id','title')->where('is_active',1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        return view('admin.product.add',[
            'title' => 'Thêm sản phẩm mới',
            'categories' => ProductCategories::select('id','title')->get(),
            'prefix' => Prefix::select('id','name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title' => 'required',
            'slug' =>'required',
            'thumb' => 'required',
            'price_type' => 'required',
            'is_active' => 'required',
            'content' => 'required'
        ]);

        $gallery = $request->gallery ? json_encode(explode(',',trim($request->gallery,','))) : null;
        DB::beginTransaction();
        try {
            $product_data = [
                'title' => $request->title,
                'slug' => $request->slug,
                'thumb' => $request->thumb,
                'gallery' => $gallery ,
                'description' => $request->description,
                'content' => $request->content,
                'categories_id' => $request->categories_id,
                'price' => $request->price,
                'price_type' => $request->price_type,
                'price_to' => $request->price_type == 1 ? $request->price_to : null,
                'sku' => $request->sku,
                'prefix_id' => $request->prefix_id,
                'inventory' => $request->inventory,
                'is_active' => $request->is_active
            ];
            $product = Product::create($product_data);
            $tags = $request->product_tags ?  explode(',',trim($request->product_tags,',')) : null;
            $tags_muti = [];
            if (is_array($tags)) {
                foreach ($tags as $key => $tag)
                {
                    $tags_muti[$key] = [
                        'title' => $tag,
                        'slug' => \Illuminate\Support\Str::slug($tag),
                        'is_active' => 1,
                        'product_id' => $product->id
                    ];
                }
            }
            if(count($tags_muti) > 0)
            {
                ProductTags::insert($tags_muti);
            }
            $seo_data = [
                'title' => $request->title_seo ? $request->title_seo : $request->title,
                'slug' => $request->slug_seo ? $request->slug_seo : $request->slug,
                'canonical' => $request->canonical_link ? $request->canonical_link : $request->slug,
                'thumb' => $request->thumb_seo ? $request->thumb_seo : $request->thumb,
                'posts_id' => $product->id,
                'google_index' => $request->google_index ?? 1,
                'type' => 'Product'
            ];
            Seo::create($seo_data);
            DB::commit();

        }
        catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('product.index')->with('success','Thêm sản phẩm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product,$id = 0)
    {
        //
        $product_qr = Product::find($id);
        if (! $product_qr) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $seo = Seo::where('type','Product')
            ->where('posts_id',$id)
            ->first();
        $tags = ProductTags::where('product_id',$id)->select('title')->get();

        return view('admin.product.edit',[
            'title' => 'Chỉnh sửa sản phẩm',
            'product' => $product_qr,
            'seo' => $seo,
            'tags' => $tags->map(function ($value){
                return $value->title;
            }),
            'categories' => ProductCategories::select('id','title')->get(),
            'prefix' => Prefix::select('id','name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id = 0)
    {
        //
        $product_find = Product::find($id);
        if (! $product_find) return back()->withErrors('Không tìm thấy thông tin dữ liệu');

        $request->validate([
            'title' => 'required',
            'slug' =>'required',
            'thumb' => 'required',
            'price_type' => 'required',
            'is_active' => 'required',
            'content' => 'required'
        ]);

        $gallery = $request->gallery ? json_encode(explode(',',trim($request->gallery,','))) : null;
        DB::beginTransaction();
        try {
            $product_data = [
                'title' => $request->title,
                'slug' => $request->slug,
                'thumb' => $request->thumb,
                'gallery' => $gallery ,
                'description' => $request->description,
                'content' => $request->content,
                'categories_id' => $request->categories_id,
                'price' => $request->price,
                'price_type' => $request->price_type,
                'price_to' => $request->price_type == 1 ? $request->price_to : null,
                'sku' => $request->sku,
                'prefix_id' => $request->prefix_id,
                'inventory' => $request->inventory,
                'is_active' => $request->is_active
            ];
            Product::where('id',$id)->update($product_data);
            $tags = $request->product_tags ?  explode(',',trim($request->product_tags,',')) : null;
            $tags_muti = [];
            $tags_db = ProductTags::select('id','title')->where('product_id',$id)->get();
            $tags_check = $tags_db->map(function ($value){
                return $value->title;
            });

            $tags_dub = [];
            if (is_array($tags)) {
                foreach ($tags as $key => $tag)
                {
                    if(! in_array($tag,$tags_check->toArray()))
                    {
                        $tags_muti[$key] = [
                            'title' => $tag,
                            'slug' => \Illuminate\Support\Str::slug($tag),
                            'is_active' => 1,
                            'product_id' => $id
                        ];
                    } else {
                        $tags_dub[] = $tag;
                    }
                }
            }
            if (count($tags_dub) > 0)
            {
                foreach ($tags_db as $tag)
                {
                    if (! in_array($tag->title,$tags_dub))
                    {
                        $tag->delete();
                    }
                }
            }

            if(count($tags_muti) > 0)
            {
                ProductTags::insert($tags_muti);
            }
            $seo_data = [
                'title' => $request->title_seo ? $request->title_seo : $request->title,
                'slug' => $request->slug_seo ? $request->slug_seo : $request->slug,
                'canonical' => $request->canonical_link ? $request->canonical_link : $request->slug,
                'thumb' => $request->thumb_seo ? $request->thumb_seo : $request->thumb,
                'google_index' => $request->google_index ?? 1,
            ];
            Seo::where('posts_id',$id)
                ->where('type','Product')
                ->update($seo_data);
            DB::commit();

        }
        catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('product.index')->with('success','Cập nhật sản phẩm thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id = 0)
    {
        //
        $product_qr = Product::find($id);
        if (! $product_qr) return back()->withErrors('Không tìm thấy thông tin dữ liệu');

        $product_qr->delete();
        Seo::where('posts_id',$id)
            ->where('type','Product')
            ->delete();
        ProductTags::where('product_id',$id)->delete();
        return back()->with('success','Xoá sản phẩm thành công');
    }
}
