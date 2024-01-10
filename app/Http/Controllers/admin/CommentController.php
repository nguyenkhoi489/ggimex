<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Comments;
use App\Models\Posts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('admin.comment.index',[
            'title' => 'Danh sách đánh giá, bình luận',
            'comment' => Comments::paginate(15)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Comments $comments,$id = 0)
    {
        //
        $cmt = Comments::find($id);
        if (! $cmt) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $post = null;
        $cmt->type == 0 ?
            $post = Posts::where('id',$cmt->product_id)->first() :
            $post = Product::where('id',$cmt->product_id)->first();
        return view('admin.comment.edit',[
            'title' => 'Chi tiết thông tin bình luận/đánh giá',
            'cmt' => $cmt,
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments, $id = 0)
    {
        $cmt = Comments::find($id);
        if (! $cmt) return back()->withErrors('Yêu cầu không hợp lệ');
        $request->validate([
            'is_active' => 'required',
            'name' => 'required',
            'email' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Comments::where('id',$id)->update($request->except(['_token','_method']));
            DB::commit();
        }catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('comment.index')->with('success','Yêu cầu được xử lý thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comment,$id = 0)
    {
        $cmt = Comments::find($id);
        if (! $cmt) return back()->withErrors('Yêu cầu không hợp lệ');
        $cmt->delete();
        return back()->with('success','Xoá bình luận/đánh giá thành công');
    }
}
