<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScriptRequest;
use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('admin.script.index', [
            'title' => 'Danh sách script',
            'scripts' => Script::select('id', 'title', 'is_active', 'created_at')->paginate(15)
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
        return view('admin.script.add', ['title' => 'Thêm Script']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ScriptRequest $scriptRequest)
    {
        //
        $scriptRequest->validate([
            'title' => 'required',
            'widget_code' => 'required',
            'position' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Script::create($scriptRequest->all());
            DB::commit();
        }
        catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('script.index')->with('success','Thêm script mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Script $script
     * @return \Illuminate\Http\Response
     */
    public function show(Script $script)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Script $script
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Script $script,$id = 0)
    {
        //
        $scr = Script::find($id);
        if(!$scr) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        return view('admin.script.edit',['title' => 'Chỉnh sửa script','script' => $scr]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Script $script
     * @return \Illuminate\Http\Response
     */
    public function update(ScriptRequest $scriptRequest, Script $script,$id = 0)
    {
        $scr = Script::find($id);
        if(!$scr) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $scriptRequest->validate([
            'title' => 'required',
            'widget_code' => 'required',
            'position' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Script::where('id',$id)->update($scriptRequest->except(['_token','_method','q']));
            DB::commit();
        }
        catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('script.index')->with('success','Chỉnh sửa script thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Script $script
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Script $script,$id = 0)
    {
        $scr = Script::find($id);
        if(!$scr) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $scr->delete();
        return back()->with('success','Xoá Script thành công');
    }
}
