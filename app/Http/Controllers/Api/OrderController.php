<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /*lay danh sach*/
    public function index()
    {
        $order = Order::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'order' => $order], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $order = Order::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'order' => $order], 200);
    }

    /* them */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = $request->user_id; //form
        $order->name = $request->name; //form
        $order->phone = $request->phone; //form
        $order->email = $request->email; //form
        $order->address = $request->address; //form
        $order->note = $request->note; //form
        $order->created_at = date('Y-m-d H:i:s');
        $order->status = $request->status; //form
        $order->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $order], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->user_id = $request->user_id; //form
        $order->name = $request->name; //form
        $order->phone = $request->phone; //form
        $order->email = $request->email; //form
        $order->address = $request->address; //form
        $order->note = $request->note; //form
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = 1;
        $order->status = $request->status; //form
        $order->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'order' => $order], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $order = Order::find($id);
        if($order == null){
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'order' => null], 200);
        }
        $order->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $order], 200);
    }

    /* lay du lieu len frontend */
    public function order_list($user_id = 1, $status = 1)
    {
        $args = [
            ['user_id', '=', $user_id],
            ['status', '=', $status]
        ];
        $data = Order::where($args)->orderBy('sort_order', 'ASC')->get();
        return response()->json($data, 200);
    }
}