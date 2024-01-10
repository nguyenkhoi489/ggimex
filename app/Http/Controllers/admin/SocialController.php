<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.social.index', [
            'title' => 'Danh sách social',
            'socials' => Social::select('id', 'title', 'thumb', 'link', 'is_active', 'created_at')->paginate(15)
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
        return view('admin.social.add', ['title' => 'Thêm mới Social']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialRequest $socialRequest)
    {
        //
        $socialRequest->validate([
            'title' => 'required',
            'thumb' => 'required',
            'link' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Social::create($socialRequest->all());
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('social.index')->with('success', 'Thêm Social mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Social $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Social $social
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Social $social, $id = 0)
    {
        //
        $social = Social::find($id);
        if (!$social) return back()->withErrors("Không tìm thấy thông tin dữ liệu");
        return view('admin.social.edit', [
            'title' => 'Chỉnh sửa thông tin social',
            'social' => $social
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Social $social
     * @return \Illuminate\Http\Response
     */
    public function update(SocialRequest $socialRequest, Social $social, $id = 0)
    {
        //
        $social = Social::find($id);
        if (!$social) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $socialRequest->validate([
            'title' => 'required',
            'thumb' => 'required',
            'link' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Social::where('id', $id)->update($socialRequest->except(['_token', '_method', 'q']));
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('social.index')->with('success', 'Cập nhật thông tin Social mới thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Social $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social, $id = 0)
    {
        //
        $social = Social::find($id);
        if (! $social) return back()->withErrors('không tìm thấy thông tin dữ liệu');
        $social->delete();
        return back()->with('success','Xoá Social thành công!');
    }
}
