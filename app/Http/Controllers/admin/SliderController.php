<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        return view('admin.slider.index',[
            'title' => 'Danh sách Slider',
            'sliders' => Slider::select('id','title','type','sort_by','is_active','created_at')->orderBy('sort_by','asc')->paginate(15)
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
        return view('admin.slider.add',[
            'title' => 'Thêm mới slider'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SliderRequest $sliderRequest)
    {
        $sliderRequest->validate([
            'thumb' => 'required',
            'type' => 'required',
            'sort_by' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Slider::create($sliderRequest->all());
            DB::commit();
        } catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('slider.index')->with('success','Thêm mới slider thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Slider $slider,$id = 0)
    {
        $slider = Slider::find($id);
        if (! $slider) return back()->withErrors('Không tìm thấy thông tin dữ liệu');

        return view('admin.slider.edit',[
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $sliderRequest, Slider $slider,$id = 0)
    {
        $sliderRequest->validate([
            'thumb' => 'required',
            'type' => 'required',
            'sort_by' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            Slider::where('id',$id)->update($sliderRequest->except(['_token','_method','q']));
            DB::commit();
        } catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('slider.index')->with('success','Cập nhật slider thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider,$id = 0)
    {
        //
        $slider = Slider::find($id);
        if (! $slider) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $slider->delete();
        return back()->with('success','Xoá slider thành công');
    }
}
