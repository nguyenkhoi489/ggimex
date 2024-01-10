<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoriesRequest;
use App\Models\PostCategories;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        return view('admin.categories.index', [
            'title' => 'Danh mục bài viết',
            'categories' => PostCategories::select('id', 'title', 'slug', 'is_active', 'created_at')
                ->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
        return view('admin.categories.add', [
            'title' => 'Thêm danh mục bài viết mới'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $postCategoriesRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCategoriesRequest $postCategoriesRequest)
    {
        //
        $postCategoriesRequest->validate([
            'title' => 'required',
            'slug' => 'required',
            'is_active' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $categories = [
                'title' => $postCategoriesRequest->title,
                'slug' => $postCategoriesRequest->slug,
                'thumb' => $postCategoriesRequest->thumb,
                'description' => $postCategoriesRequest->description,
                'is_active' => $postCategoriesRequest->is_active
            ];
            $category = PostCategories::create($categories);
            $seo = [
                'title' => ($postCategoriesRequest->title_seo) ?
                    $postCategoriesRequest->title_seo :
                    $postCategoriesRequest->title,
                'slug' => ($postCategoriesRequest->slug_seo) ?
                    $postCategoriesRequest->slug_seo :
                    $postCategoriesRequest->slug,
                'canonical' => ($postCategoriesRequest->canonical_link) ?
                    $postCategoriesRequest->canonical_link :
                    $postCategoriesRequest->slug,
                'thumb' =>  ($postCategoriesRequest->thumb_seo) ?
                    $postCategoriesRequest->thumb_seo :
                    $postCategoriesRequest->thumb,
                'description' => ($postCategoriesRequest->description_seo) ?
                    $postCategoriesRequest->description_seo :
                    $postCategoriesRequest->description,
                'posts_id' => $category->id,
                'google_index' => $postCategoriesRequest->google_index?? 1,
                'type' => 'PostCategories'
            ];
            Seo::create($seo);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PostCategories $postCategories
     */
    public function edit(PostCategories $postCategories,$id = 0)
    {
        //
        $categories = PostCategories::find($id);
        if (! $categories) return back()->withErrors('Không tìm thấy dữ liệu');

        return view('admin.categories.edit',[
            'title' => 'Chỉnh sửa danh mục',
            'categories' => $categories,
            'seo' => Seo::where('posts_id',$categories->id)
                ->where('type','PostCategories')
                ->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $postCategoriesRequest
     * @param \App\Models\PostCategories $postCategories
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoriesRequest $postCategoriesRequest, PostCategories $postCategories,$id = 0)
    {
        $categories = PostCategories::find($id);
        if (! $categories) return redirect()->route('categories.index')->withErrors('Không tìm thấy thông tin dữ liệu');
        $postCategoriesRequest->validate([
            'title' => 'required',
            'slug' => 'required',
            'is_active' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $categories = [
                'title' => $postCategoriesRequest->title,
                'slug' => $postCategoriesRequest->slug,
                'thumb' => $postCategoriesRequest->thumb,
                'description' => $postCategoriesRequest->description,
                'is_active' => $postCategoriesRequest->is_active
            ];
            PostCategories::where('id',$id)->update($categories);
            $seo = [
                'title' => ($postCategoriesRequest->title_seo) ?
                    $postCategoriesRequest->title_seo :
                    $postCategoriesRequest->title,
                'slug' => ($postCategoriesRequest->slug_seo) ?
                    $postCategoriesRequest->slug_seo :
                    $postCategoriesRequest->slug,
                'canonical' => ($postCategoriesRequest->canonical_link) ?
                    $postCategoriesRequest->canonical_link :
                    $postCategoriesRequest->slug,
                'thumb' =>  ($postCategoriesRequest->thumb_seo) ?
                    $postCategoriesRequest->thumb_seo :
                    $postCategoriesRequest->thumb,
                'description' => ($postCategoriesRequest->description_seo) ?
                    $postCategoriesRequest->description_seo :
                    $postCategoriesRequest->description,
                'google_index' => $postCategoriesRequest->google_index?? 1,
            ];
            Seo::where('type','PostCategories')
                ->where('posts_id',$id)
                ->update($seo);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PostCategories $postCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategories $postCategories,$id = 0)
    {
        //
        $categories = PostCategories::find($id);
        if (! $categories) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $seo = Seo::where('posts_id',$id)
            ->where('type','PostCategories')
            ->first();
        $categories->delete();
        $seo->delete();
        return  back()->with('success','Xoá danh mục thành công');
    }
}
