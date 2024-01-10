<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('admin.user.index', [
            'title' => "Danh sách quản trị viên",
            'user' => User::paginate(15)
        ]);
    }

    public function create()
    {
        return view('admin.user.add', ['title' => 'Thêm thành viên mới']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = [
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => password_hash($request->password,PASSWORD_BCRYPT),
                'roles_id' => 1,
                'email_verified_at' => now(),
                'is_active' => $request->is_active
            ];
            User::create($data);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('admin.index')->with('success', 'Thêm thành viên mới thành công');
    }

    public function edit($id = 0)
    {
        $user = User::find($id);
        if (! $user) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        return view('admin.user.edit',[
            'title' => 'Thông tin cá nhân',
            'user' => $user
        ]);
    }
    public function update( Request $request, $id = 0)
    {
        $user = User::find($id);
        if (! $user) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        DB::beginTransaction();
        try {
            $db = [
                'fullname' => $request->fullname,
                'is_active' => $request->is_active
            ];
            $request->password !== null ? $db['password'] = password_hash($request->password,PASSWORD_BCRYPT) : "";
            User::where('id',$id)->update($db);
            DB::commit();
        }catch (\Exception $error)
        {
            DB::rollBack();
            return back()->withErrors($error->getMessage());
        }
        return redirect()->route('admin.index')->with('success','Cập nhật thông tin thành công!');
    }
    public function destroy($id = 0)
    {
        $user = User::find($id);
        if (! $user) return back()->withErrors('Không tìm thấy thông tin dữ liệu');
        $user->delete();
        return redirect()->route('admin.index')->with('success','Xoá User thành công!');
    }
}
