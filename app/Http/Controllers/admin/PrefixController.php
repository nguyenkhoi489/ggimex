<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrefixRequest;
use App\Models\Prefix;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrefixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('admin.prefix.index',[
            'title' => 'Danh sách tiền tệ',
            'prefix' => Prefix::select('id','name','value','is_active','created_at')->paginate(15)
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
        return view('admin.prefix.add',[
            'title' => 'Thêm mới tiền tệ'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PrefixRequest $prefixRequest)
    {
        //
        $prefixRequest->validate([
            'name' => 'required',
            'value' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Prefix::create($prefixRequest->all());
            DB::commit();
        }
        catch (\Exception $error){
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('prefix.index')->with('success','Thêm đơn vị tiền tệ thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prefix  $prefix
     * @return \Illuminate\Http\Response
     */
    public function show(Prefix $prefix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prefix  $prefix
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Prefix $prefix,$id = 0)
    {
        //
        $prefix = Prefix::find($id);
        if (! $prefix) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        return view('admin.prefix.edit',[
            'title' => 'Chỉnh sửa đơn vị tiền tệ',
            'prefix' => $prefix
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prefix  $prefix
     * @return \Illuminate\Http\Response
     */
    public function update(PrefixRequest $prefixRequest, Prefix $prefix, $id = 0)
    {
        //
        $prefix = Prefix::find($id);
        if (! $prefix) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $prefixRequest->validate([
            'name' => 'required',
            'value' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Prefix::where('id',$id)->update($prefixRequest->except(['_token','_method','q']));
            DB::commit();
        }
        catch (\Exception $error){
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('prefix.index')->with('success','Cập nhật đơn vị tiền tệ thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prefix  $prefix
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prefix $prefix,$id = 0)
    {
        $prefix = Prefix::find($id);
        if (! $prefix) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $prefix->delete();
        return back()->with('success','Xoá đơn vị tiền tệ thành công');
    }
}
