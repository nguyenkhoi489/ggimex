<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\PostCategories;
use App\Models\ProductCategories;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('admin.pages.index',[
            'title' => 'Danh sách pages',
            'pages' => Pages::select('id','title','is_active','created_at','slug')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.add',[
            'title' => 'Thêm pages mới'
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
            'is_active' => 'required',
            'slug' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $page = [
                'title' => $request->title,
                'slug' => ($request->slug == $request->slug_seo) ?
                    $request->slug :
                    ($request->slug_seo != null ? $request->slug_seo : $request->slug),
                'content' => $request->content,
                'thumb' => $request->thumb,
                'is_active' => $request->is_active,
            ];
            $page_id = Pages::create($page);
            $seo = [
                'title' => $request->title_seo ? $request->title_seo : $request->title,
                'slug' => $request->slug_seo ? $request->slug_seo : $request->slug,
                'canonical' => $request->canonical_link ? $request->canonical_link : $request->slug,
                'thumb' => $request->thumb_seo ? $request->thumb_seo : $request->thumb,
                'posts_id' => $page_id->id,
                'google_index' => $request->google_index ?? 1,
                'type' => 'Pages'
            ];
            Seo::create($seo);
            DB::commit();
        }catch (Exception $error){
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('pages.index')->with('success','Thêm pages mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Pages $pages,$id = 0)
    {
        //
        $page = Pages::find($id);
        if (! $page) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        if ($id == 1)
        {
            $category = ProductCategories::select('id','title')->where('is_active',1)->get();
        }
        return view('admin.pages.edit',[
            'title' => 'Chỉnh sửa Pages',
            'page' => $page,
            'category' =>$category ?? null,
            'seo' => Seo::where('type','Pages')->where('posts_id',$id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pages $pages,$id = 0)
    {
        //
        $page = Pages::find($id);
        if (! $page) return redirect()->route('pages.index')->withErrors('Yêu cầu không hợp lệ!');
        $request->validate([
            'title' => 'required',
            'is_active' => 'required',
            'slug' => 'required'
        ]);
        if ($id == 1)
        {
            $content = [
                'title_product' => $request->title_product,
                'sub_title_product' => $request->sub_title_product,
                'title_category' => $request->title_category,
                'category' => $request->category,
                'sub_title_category' => $request->sub_title_category,
                'quality_title_1' => $request->quality_title_1,
                'quality_thumb_1' => $request->quality_thumb_1,
                'quality_des_1' => $request->quality_des_1,
                'quality_title_2' => $request->quality_title_2,
                'quality_thumb_2' => $request->quality_thumb_2,
                'quality_des_2' => $request->quality_des_2,
                'quality_title_3' => $request->quality_title_3,
                'quality_thumb_3' => $request->quality_thumb_3,
                'quality_des_3' => $request->quality_des_3,
                'title_market' => $request->title_market,
                'thumb_market' =>$request->thumb_market
            ];
        }
        DB::beginTransaction();
        try {
            $page = [
                'title' => $request->title,
                'slug' => ($request->slug == $request->slug_seo) ?
                    $request->slug :
                    ($request->slug_seo != null ? $request->slug_seo : $request->slug),
                'content' => ($id == 1 ? json_encode($content) : $request->content),
                'thumb' => $request->thumb,
                'is_active' => $request->is_active,
            ];
            Pages::where('id',$id)->update($page);
            $seo = [
                'title' => $request->title_seo ? $request->title_seo : $request->title,
                'slug' => $request->slug_seo ? $request->slug_seo : $request->slug,
                'canonical' => $request->canonical_link ? $request->canonical_link : $request->slug,
                'thumb' => $request->thumb_seo ? $request->thumb_seo : $request->thumb,
                'google_index' => $request->google_index ?? 1,
            ];
            Seo::where('type','Pages')->where('posts_id',$id)->update($seo);
            DB::commit();
        }catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('pages.index')->with('success','Update pages thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pages $pages,$id = 0)
    {
        $page = Pages::find($id);
        if (! $page) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        if ($id === 1) return back()->withErrors('Xin lỗi, bạn không thể xoá pages này');
        $page->delete();
        return back()->with('success','Xoá page thành công!');
        //
    }
}
