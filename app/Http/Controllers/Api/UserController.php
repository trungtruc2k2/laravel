<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /** Xác thực đăng nhập */
    public function authLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['message' => 'Email không tồn tại'], 400);
        }
        if ($credentials['password'] != $user->password) {
            return response()->json(['message' => 'Sai mật khẩu'], 400);
        }
        return response()->json(['user' => $user]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:db_user',
            'username' => 'required|unique:db_user',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user = new User();
        $user->name = $request->name; //form
        $user->email = $request->email; //form
        $user->phone = $request->phone; //form
        $user->username = $request->username; //form
        $user->password = $request->password; //form
        $user->address = $request->address; //form
        //upload hình ảnh
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $user->slug . '.' . $extension;
                $user->image = $filename;
                $files->move(public_path('images/user'), $filename);
            }
        }
        //
        $user->roles = $request->roles; //form
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = 1;
        $user->status = $request->status; //form
        $user->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $user], 201);
    }

    /*lay danh sach*/
    public function index()
    {
        $user = User::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'user' => $user], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'user' => $user], 200);
    }

    /* them */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name; //form
        $user->email = $request->email; //form
        $user->phone = $request->phone; //form
        $user->username = $request->username; //form
        $user->password = $request->password; //form
        $user->address = $request->address; //form
        //upload hình ảnh
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $user->slug . '.' . $extension;
                $user->image = $filename;
                $files->move(public_path('images/user'), $filename);
            }
        }
        //
        $user->roles = $request->roles; //form
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = 1;
        $user->status = $request->status; //form
        $user->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $user], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name; //form
        $user->email = $request->email; //form
        $user->phone = $request->phone; //form
        $user->username = $request->username; //form
        $user->password = $request->password; //form
        $user->address = $request->address; //form
        //upload hình ảnh
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $user->name . '.' . $extension;
                $user->image = $filename;
                $files->move(public_path('images/user'), $filename);
            }
        }
        //
        $user->roles = $request->roles; //form
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = 1;
        $user->status = $request->status; //form
        $user->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'user' => $user], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'user' => null], 200);
        }
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $user], 200);
    }

    /* lay du lieu len frontend */
    public function user_list($status = 1)
    {
        $args = [
            ['status', '=', $status]
        ];
        $data = User::where($args)->orderBy('sort_order', 'ASC')->get();
        return response()->json($data, 200);
    }
}
