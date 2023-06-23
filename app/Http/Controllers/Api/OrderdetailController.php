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
        $order->order_id = $request->order_id; //form
        $order->product_id = $request->product_id; //form
        $order->price = $request->price; //form
        $order->qty = $request->qty; //form
        $order->amount = $request->amount; //form
        $order->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $order], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_id = $request->order_id; //form
        $order->product_id = $request->product_id; //form
        $order->price = $request->price; //form
        $order->qty = $request->qty; //form
        $order->amount = $request->amount; //form
        $order->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'order' => $order], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $orderdetail = Orderdetail::find($id);
        if($orderdetail == null){
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'orderdetail' => null], 200);
        }
        $orderdetail->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $orderdetail], 200);
    }

    /* lay du lieu len frontend */
    public function order_list($order_id = 1, $status = 1)
    {
        $args = [
            ['order_id', '=', $order_id],
            ['status', '=', $status]
        ];
        $data = Order::where($args)->orderBy('sort_order', 'ASC')->get();
        return response()->json($data, 200);
    }
}