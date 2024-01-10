<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use App\Models\PostCategories;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        return view('admin.menus.index',[
           'title' => 'Danh sách Menus',
           'menus' => Menus::select('id','title','type','sort_by','parent_id','is_active','created_at')->orderby('sort_by','asc')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.menus.add',[
            'title' => 'Thêm mới Menus',
            'menus' => Menus::where('parent_id',0)->get()
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
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'sort_by' => 'required',
            'parent_id' => 'required',
            'is_active' => 'required'
        ]);
        $slug = $request->slug;
        if ($request->type == 2) {
            $slug = (PostCategories::select('slug')->where('id',$request->table_id)->first())->slug;
        }
        if ($request->type == 1) {
            $slug = (ProductCategories::select('slug')->where('id',$request->table_id)->first())->slug;
        }
        DB::beginTransaction();
        try {
            $data = [
                'title' => $request->title,
                'slug' => $slug,
                'type' => $request->type,
                'parent_id' => $request->parent_id,
                'table_id' => $request->table_id ?? 0,
                'sort_by' => $request->sort_by,
                'is_active' => $request->is_active
            ];
            Menus::create($data);
            DB::commit();
        }catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('menus.index')->with('success','Thêm menu mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(Menus $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Menus $menus,$id = 0)
    {
        //
        $menu = Menus::where('id',$id)->first();
        if (! $menu) return back()->withErrors("Không tìm thấy thông tin dữ liệu");
        return view('admin.menus.edit',[
            'title' => 'Chỉnh sửa menus',
            'menu' => $menu,
            'menus' => Menus::where('is_active',1)->where('parent_id',0)->get(),
            'product_cat' => ProductCategories::select('title','id')->where('is_active',1)->get(),
            'post_cat' => PostCategories::select('title','id')->where('is_active',1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menus $menus,$id = 0)
    {
        //
        $menu = Menus::find($id);
        if (! $menu) return back()->withErrors('Không tìm thấy thông tin dữ liệu');

        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'sort_by' => 'required',
            'parent_id' => 'required',
            'is_active' => 'required'
        ]);
        $slug = $request->slug;
        if ($request->type == 2) {
            $slug = (PostCategories::select('slug')->where('id',$request->table_id)->first())->slug;
        }
        if ($request->type == 1) {
            $slug = (ProductCategories::select('slug')->where('id',$request->table_id)->first())->slug;
        }
        DB::beginTransaction();
        try {
            $data = [
                'title' => $request->title,
                'slug' => $slug,
                'type' => $request->type,
                'parent_id' => $request->parent_id,
                'table_id' => $request->table_id ?? 0,
                'sort_by' => $request->sort_by,
                'is_active' => $request->is_active
            ];
            Menus::where('id',$id)->update($data);
            DB::commit();
        }catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('menus.index')->with('success','Cập nhật menu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menus $menus,$id = 0)
    {
        //
        $menu = Menus::find($id);
        if (! $menu) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $menu->delete();
        return back()->with('success','Xoá Menu thành công!');
    }
}
