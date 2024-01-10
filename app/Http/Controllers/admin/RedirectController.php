<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RedirectRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RedirectRoles $redirectRoles)
    {
        //
        return view('admin.redirect.index',
            [
                'title' => 'Danh sách điều hướng Link',
                'links' => RedirectRoles::simplePaginate(15)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.redirect.add',['title' => 'Thêm link mới']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,RedirectRoles $redirectRoles)
    {
        //
        $this->validate($request,
            [
                'old_url' => 'required',
                'new_url' => 'required',
                'type' => 'required'
            ]
        );
        DB::beginTransaction();
        try {
            $data = $request->except(['_token']);
            RedirectRoles::create($data);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('redirect.index')->with('success','Thêm điều hướng link thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id = 0,RedirectRoles $redirectRoles)
    {
        //
        $link = RedirectRoles::find($id);
        if (! $link) return back()->withErrors('Không tìm thấy thông tin dữ liệu!');

        return view('admin.redirect.edit',
            [
                'title' => 'Thay đổi điều hướng Link',
                'link' => $link
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id = 0,Request $request, RedirectRoles $RedirectRoles)
    {
        $link = RedirectRoles::find($id);
        if (! $link) return redirect()->route('car_version.index')->withErrors('Yêu cầu không hợp lệ!');
        $validate = $this->validate($request,
            [
                'old_url' => 'required',
                'new_url' => 'required',
                'type' => 'required',
            ]
        );
        DB::beginTransaction();
        try {
            $link = $request->except(['_token','_method']);
            RedirectRoles::where('id',$id)->update($link);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('redirect.index')->with('success','Update dữ liệu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = 0,RedirectRoles $RedirectRoles)
    {
        //
        $link = RedirectRoles::find($id);
        if (! $link) return back()->withErrors('Không tìm thấy dữ liệu ');
        $link->delete();
        return back()->with('success','Xoá thành công!');
    }
}
