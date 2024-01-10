<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequest;
use App\Models\PostCategories;
use App\Models\Posts;
use App\Models\Seo;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        $category_id = \request()->input('category');
        $status = \request()->input('is_active');
        $title = \request()->input('title');

        return view('admin.posts.index', [
            'title' => 'Bài viết',
            'posts' => Posts::select(['posts.id', 'posts.title', 'posts.slug', 'post_categories.title as categories_name', 'posts.created_at', 'posts.is_active'])
                ->when($category_id != 0,function ($query) use ($category_id){
                    $query->where('posts.categories_id',$category_id);
                })
                ->when($status !== "all" && $status !== null,function ($query) use ($status){
                    $query->where('posts.is_active',$status);
                })
                ->when($title != null,function ($query) use ($title){
                    $query->where('posts.title','LIKE',"%{$title}%");
                })
                ->join('post_categories', function ($join) {
                    $join->on('post_categories.id', '=', 'posts.categories_id');
                })
                ->paginate(15),
            'category' => PostCategories::select('id','title')->where('is_active',1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
        return view('admin.posts.add', [
            'title' => 'Thêm bài viết mới',
            'categories' => PostCategories::select('title', 'id')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $postsRequest)
    {
        //
        $postsRequest->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'categories_id' => 'required',
            'is_active' => 'required',
            'thumb' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $post = [
                'title' => $postsRequest->title,
                'slug' => ($postsRequest->slug == $postsRequest->slug_seo) ?
                    $postsRequest->slug :
                    ($postsRequest->slug_seo != null ? $postsRequest->slug_seo : $postsRequest->slug),
                'content' => $postsRequest->content,
                'categories_id' => $postsRequest->categories_id,
                'thumb' => $postsRequest->thumb,
                'is_active' => $postsRequest->is_active,
                'author_id' => auth()->user()->id
            ];
            $post_insert = Posts::create($post);
            $seo = [
                'title' => $postsRequest->title_seo ? $postsRequest->title_seo : $postsRequest->title,
                'slug' => $postsRequest->slug_seo ? $postsRequest->slug_seo : $postsRequest->slug,
                'canonical' => $postsRequest->canonical_link ? $postsRequest->canonical_link : $postsRequest->slug,
                'thumb' => $postsRequest->thumb_seo ? $postsRequest->thumb_seo : $postsRequest->thumb,
                'posts_id' => $post_insert->id,
                'google_index' => $postsRequest->google_index ?? 1,
                'type' => 'Posts'
            ];
            Seo::create($seo);
            DB::commit();

        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('posts.index')->with('success', 'Thêm bài viết thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Posts $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Posts $posts
     */
    public function edit(Posts $posts, $id = 0)
    {
        //
        $post = Posts::find($id);
        if (!$post) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $seo = Seo::where('type', 'Posts')
            ->where('posts_id', $id)
            ->first();
        return view('admin.posts.edit', [
            'title' => 'Chỉnh sửa bài viết',
            'post' => $post,
            'seo' => $seo,
            'categories' => PostCategories::select('id', 'title')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Posts $posts
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $postsRequest, $id = 0)
    {
        //
        $post = Posts::find($id);
        if (!$post) return redirect()->route('posts.index')->withErrors("không tìm thấy thông tin dữ liệu");

        $postsRequest->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'categories_id' => 'required',
            'thumb' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $post = [
                'title' => $postsRequest->title,
                'slug' => ($postsRequest->slug == $postsRequest->slug_seo) ?
                    $postsRequest->slug :
                    ($postsRequest->slug_seo != null ? $postsRequest->slug_seo : $postsRequest->slug) ,
                'content' => $postsRequest->content,
                'categories_id' => $postsRequest->categories_id,
                'thumb' => $postsRequest->thumb,
                'is_active' => $postsRequest->is_active
            ];
            Posts::where('id',$id)->update($post);
            $seo = [
                'title' => $postsRequest->title_seo ? $postsRequest->title_seo : $postsRequest->title,
                'slug' => $postsRequest->slug_seo ? $postsRequest->slug_seo : $postsRequest->slug,
                'canonical' => $postsRequest->canonical_link ? $postsRequest->canonical_link : $postsRequest->slug,
                'thumb' => $postsRequest->thumb_seo ? $postsRequest->thumb_seo : $postsRequest->thumb,
                'google_index' => $postsRequest->google_index ?? 1,
            ];
            Seo::where('type','Posts')
                ->where('posts_id',$id)->update($seo);
            DB::commit();

        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Posts $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
