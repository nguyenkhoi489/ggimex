<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatWidgetRequest;
use App\Models\ChatWidget;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ChatWidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        return view('admin.chatwidget.index', [
            'title' => 'Danh sách chatwidget',
            'widgets' => ChatWidget::select('id', 'title', 'thumb', 'link', 'is_active', 'created_at')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
        return view('admin.chatwidget.add', [
            'title' => 'Thêm mới Chatwidget'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(ChatWidgetRequest $chatWidgetRequest)
    {
        //
        $chatWidgetRequest->validate([
            'title' => 'required',
            'link' => 'required',
            'thumb' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            ChatWidget::create($chatWidgetRequest->all());
            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('chatwidget.index')->with('success','Thêm chatwidget thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param ChatWidget $chatWidget
     * @return Response
     */
    public function show(ChatWidget $chatWidget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ChatWidget $chatWidget
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(ChatWidget $chatWidget,$id = 0)
    {
        //
        $widget = ChatWidget::find($id);
        if (! $widget) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        return view('admin.chatwidget.edit',[
            'title' => 'Chỉnh sửa Chatwidget',
            'chatwidget' => $widget
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ChatWidget $chatWidget
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChatWidgetRequest $chatWidgetRequest, ChatWidget $chatWidget,$id = 0)
    {
        //
        $widget = ChatWidget::find($id);
        if (! $widget) return redirect()->route('chatwidget.index')->withErrors('Không tìm thấy thông tin dữ liệu');
        $chatWidgetRequest->validate([
            'title' => 'required',
            'link' => 'required',
            'thumb' => 'required',
            'is_active' => 'required'
        ]);
        DB::beginTransaction();
        try {
            ChatWidget::where('id',$id)->update($chatWidgetRequest->except(['_token','_method']));
            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('chatwidget.index')->with('success','Cập nhật chatwidget thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ChatWidget $chatWidget
     * @return Response
     */
    public function destroy(ChatWidget $chatWidget,$id = 0)
    {
        //
        $widget = ChatWidget::find($id);
        if (! $widget) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $widget->delete();
        return back()->with('success','Xoá widget thành công');
    }
}
