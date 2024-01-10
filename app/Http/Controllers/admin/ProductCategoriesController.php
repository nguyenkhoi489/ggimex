<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoriesRequest;
use App\Models\ProductCategories;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('admin.productcategories.index', [
            'title' => 'Danh sách danh mục sản phẩm',
            'categories' => ProductCategories::select('id', 'title', 'slug', 'is_active', 'created_at')->paginate(15)
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
        return view('admin.productcategories.add', [
            'title' => 'Thêm danh mục sản phẩm'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoriesRequest $productCategoriesRequest)
    {
        $productCategoriesRequest->validate([
            'title' => 'required',
            'slug' => 'required',
            'is_active' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $categories = [
                'title' => $productCategoriesRequest->title,
                'slug' => $productCategoriesRequest->slug,
                'thumb' => $productCategoriesRequest->thumb,
                'description' => $productCategoriesRequest->description,
                'is_active' => $productCategoriesRequest->is_active
            ];
            $category = ProductCategories::create($categories);
            $seo = [
                'title' => ($productCategoriesRequest->title_seo) ?
                    $productCategoriesRequest->title_seo :
                    $productCategoriesRequest->title,
                'slug' => ($productCategoriesRequest->slug_seo) ?
                    $productCategoriesRequest->slug_seo :
                    $productCategoriesRequest->slug,
                'canonical' => ($productCategoriesRequest->canonical_link) ?
                    $productCategoriesRequest->canonical_link :
                    $productCategoriesRequest->slug,
                'thumb' => ($productCategoriesRequest->thumb_seo) ?
                    $productCategoriesRequest->thumb_seo :
                    $productCategoriesRequest->thumb,
                'description' => ($productCategoriesRequest->description_seo) ?
                    $productCategoriesRequest->description_seo :
                    $productCategoriesRequest->description,
                'posts_id' => $category->id,
                'google_index' => $productCategoriesRequest->google_index ?? 1,
                'type' => 'ProductCategories'
            ];
            Seo::create($seo);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('product.categories.index')->with('success', 'Thêm danh mục sản phẩm thành công thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductCategories $productCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategories $productCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProductCategories $productCategories
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ProductCategories $productCategories, $id = 0)
    {
        //
        $categories = ProductCategories::find($id);
        if (!$categories) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        return view('admin.productcategories.edit', [
            'title' => 'Chỉnh sửa danh mục sản phẩm',
            'categories' => $categories,
            'seo' => Seo::where('type', 'ProductCategories')
                ->where('posts_id', $id)
                ->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductCategories $productCategories
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoriesRequest $productCategoriesRequest, ProductCategories $productCategories,$id = 0)
    {
        $categories = ProductCategories::find($id);
        if (! $categories) return redirect()->route('product.categories.index')->withErrors('Không tìm thấy thông tin dữ liệu');
        $productCategoriesRequest->validate([
            'title' => 'required',
            'slug' => 'required',
            'is_active' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $categories = [
                'title' => $productCategoriesRequest->title,
                'slug' => $productCategoriesRequest->slug,
                'thumb' => $productCategoriesRequest->thumb,
                'description' => $productCategoriesRequest->description,
                'is_active' => $productCategoriesRequest->is_active
            ];
            ProductCategories::where('id',$id)->update($categories);
            $seo = [
                'title' => ($productCategoriesRequest->title_seo) ?
                    $productCategoriesRequest->title_seo :
                    $productCategoriesRequest->title,
                'slug' => ($productCategoriesRequest->slug_seo) ?
                    $productCategoriesRequest->slug_seo :
                    $productCategoriesRequest->slug,
                'canonical' => ($productCategoriesRequest->canonical_link) ?
                    $productCategoriesRequest->canonical_link :
                    $productCategoriesRequest->slug,
                'thumb' =>  ($productCategoriesRequest->thumb_seo) ?
                    $productCategoriesRequest->thumb_seo :
                    $productCategoriesRequest->thumb,
                'description' => ($productCategoriesRequest->description_seo) ?
                    $productCategoriesRequest->description_seo :
                    $productCategoriesRequest->description,
                'google_index' => $productCategoriesRequest->google_index ?? 1,
            ];
            Seo::where('type','ProductCategories')
                ->where('posts_id',$id)
                ->update($seo);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('product.categories.index')->with('success', 'Cập nhật danh mục sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductCategories $productCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategories $productCategories,$id = 0)
    {
        $categories = ProductCategories::find($id);
        if (! $categories) return redirect()->route('product.categories.index')->withErrors('Không tìm thấy thông tin dữ liệu');
        $categories->delete();
        $seo =Seo::where('type','ProductCategories')
            ->where('posts_id',$id)
            ->first();
        $seo->delete();
        return back()->with('success', 'Xoá danh mục sản phẩm thành công');

    }
}
