<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::where('id',1)->first();
        return view('admin.setting', [
            'title' => 'Cấu hình Website',
            'settings' => $settings
        ]);
    }

    public function update(SettingRequest $settingRequest)
    {
        $settingRequest->validate([
            'title' => 'required',
            'google_index' => 'required',
            'status' => 'required'
        ]);
        $data = $settingRequest->except(['_token','_method','q']);

        DB::beginTransaction();
        try {
            Setting::where('id',1)->update($data);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return back()->with('success','Cập nhật thông tin thành công!');
    }

}
