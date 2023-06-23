<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /*lay danh sach*/
    public function index()
    {
        $menu = Menu::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'menu' => $menu], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $menu = Menu::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'menu' => $menu], 200);
    }

    /* them */
    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->user_id = $request->user_id; //form
        $menu->name = $request->name; //form
        $menu->link = $request->link; //form
        $menu->table_id = $request->table_id; //form
        $menu->type = $request->type; //form
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = 1;
        $menu->status = $request->status; //form
        $menu->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $menu], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->user_id = $request->user_id; //form
        $menu->name = $request->name; //form
        $menu->link = $request->link; //form
        $menu->table_id = $request->table_id; //form
        $menu->type = $request->type; //form
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        $menu->status = $request->status; //form
        $menu->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'menu' => $menu], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if($menu == null){
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'menu' => null], 200);
        }
        $menu->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $menu], 200);
    }

    /* lay du lieu len frontend */
    public function menu_list($position, $parent_id = 0)
    {
        $args = [
            ['position', '=', $position],
            ['parent_id', '=', $parent_id],
            ['status', '=', 1]
        ];
        $menus = Menu::where($args)
            ->orderBy('sort_order', 'ASC')
            ->get();
            if(count($menus)){
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Tải dữ liệu thành công',
                        'menus' => $menus
                    ],
                    200
                );
            }else{
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Không có dữ liệu',
                        'menus' => null
                    ],
                    200
                );
            }
    }

}