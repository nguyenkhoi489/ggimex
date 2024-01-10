<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('admin.contact.index',[
            'title' => 'Danh sách thông tin liên hệ',
            'contact' => Contacts::paginate(15)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Contacts $contacts,$id = 0)
    {
        $contact = Contacts::find($id);
        if (! $contact) return back()->withErrors('Không tìm thấy thông tin dữ liệu');

        return view('admin.contact.edit',[
            'title' => "Thông tin chi tiết",
            'contact' => $contact
        ]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contacts,$id = 0)
    {
        //
        $contact = Contacts::find($id);
        if (! $contact) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $contact->delete();
        return back()->with('success','Xoá thông tin liên hệ thành công');
    }
}
