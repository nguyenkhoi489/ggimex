<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    //
    protected $filesize = 1024000 * 2;
    protected $mediaType = ['image/jpeg', 'image/png', 'image/webp'];

    public function index()
    {
        $folder = request()->get('folder') ? 'public/'. \request()->get('pages') : 'public';
        $list_files = Storage::allFiles($folder);
        $pages = \request()->get('pages') ? \request()->get('pages') : 1;
        $images = [];
        $limit = 20;
        $offset = ($pages - 1) * $limit;
        foreach ($list_files as $item) {
            if (in_array(Storage::mimeType($item),$this->mediaType)) {
                $images[] = str_replace('public','storage',$item);
            }
        }
        return view('admin.media.index',[
            'title' => 'Thư viện hình ảnh',
            'folder' => (new \App\Helper\Helper())->filter_folder($folder),
            'files' => array_slice(array_reverse($images),$offset,$limit)
        ]);
    }

    //Tải lên hình ảnh
    public function store(Request $request)
    {

        if (!$request->file('file')) return \response()->json(['error' => true, 'message' => 'Vui lòng chọn file cần upload']);
        $file = $request->file('file');

        if ($file->getSize() > $this->filesize) return \response()->json(['error' => true, 'message' => 'Vượt qua kích thước cho phép tải lên [2MB]']);

        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        if (!in_array($file->getMimeType(), $this->mediaType)) return \response()->json(['error' => true, 'message' => 'Định dạng file không hợp lệ']);
        $name = time() . $fileName;
        Storage::putFileAs('public/' . date('Y/m/d') . '/', $file, $name);
        return \response()->json(['error' => false, 'message' => 'Upload thành công', 'url' => 'storage/' . date('Y/m/d') . '/' . $name]);
    }

    //Tải lên hình ảnh voi ckeditor 4
    public function show(Request $request)
    {
        $file = $request->file('upload');
        if ($file->getSize() > $this->filesize) return \response()->json(['error' => true, 'message' => 'Vượt qua kích thước cho phép tải lên [2MB]']);

        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        if (!in_array($file->getMimeType(), $this->mediaType)) return \response()->json(['error' => true, 'message' => 'Định dạng file không hợp lệ']);
        $name = time() . $fileName;

        Storage::putFileAs('public/' . date('Y/m/d') . '/', $file, $name);
        $url = route('home') . '/storage/' . date('Y/m/d') . '/' . $name;
        return response()->json(['fileName' => $name, 'uploaded' => 1, 'url' => $url]);

    }

    public function showAllMedia()
    {
        $list_files = Storage::allFiles('public');
        $pages = \request()->get('pages') ? \request()->get('pages') : 1;
        $images = [];
        $limit = 20;
        $offset = ($pages - 1) * $limit;
        foreach ($list_files as $item) {
            if (in_array(Storage::mimeType($item),$this->mediaType)) {
                $images[] = str_replace('public','storage',$item);
            }
        }
        if ($offset > count($images))
        {
            return response()->json(['data' => '']);
        }
        $files = array_slice(array_reverse($images),$offset,$limit);
        return response()->json(['data' => $files]);
    }

    public function destroy($re)
    {

    }
}
