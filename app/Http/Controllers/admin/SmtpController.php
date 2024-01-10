<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmtpRequest;
use App\Models\Smtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmtpController extends Controller
{

    public function index()
    {
        //
        return view('admin.smtp',[
            'title' => 'Cấu hình thông tin SMTP (Mail)',
            'smtp' => Smtp::where('id',1)->first()
        ]);

    }
    public function update(SmtpRequest $smtpRequest)
    {

        $smtpRequest->validate([
            'smtp_type' => 'required',
            'host' => 'required',
            'user' => 'required',
            'password' => 'required',
            'port' => 'required',
            'type' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $data = $smtpRequest->except(['_token','_method','q']);
            $data['password'] = (new  \App\Helper\Helper())->encrypt($data['password']);
            Smtp::where('id',1)->update($data);
            DB::commit();
        }catch (\Exception $error) {
            return back()->withErrors($error->getMessage());
        }
        return back()->with('success','Cập nhật thông tin thành công');
    }

}
