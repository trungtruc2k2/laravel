<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /*lay danh sach*/
    public function index()
    {
        $brand = Brand::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'brand' => $brand], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $brand = Brand::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'brand' => $brand], 200);
    }

    /* them */
    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->name; //form
        $brand->slug = $request->slug;
        // $brand->image = $request->name;
        //upload hình ảnh
        $files=$request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $brand->slug . '.' . $extension;
                $brand->image = $filename;
                $files->move(public_path('images/brand'), $filename);
            }
        }
        //
        $brand->sort_order = $request->sort_order; //form
        $brand->metakey = $request->metakey; //form
        $brand->metadesc = $request->metadesc; //form
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->created_by = 1;
        $brand->status = $request->status; //form
        $brand->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $brand], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name; // form
        $brand->slug = Str::of($request->name)->slug('-');
        // $brand->image = $request->name;
        //upload hình ảnh
        $files=$request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $brand->slug . '.' . $extension;
                $brand->image = $filename;
                $files->move(public_path('images/brand'), $filename);
            }
        }
        //
        $brand->sort_order = $request->sort_order; //form
        $brand->metakey = $request->metakey; //form
        $brand->metadesc = $request->metadesc; //form
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = 1;
        $brand->status = $request->status; //form
        $brand->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'brand' => $brand], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand == null){
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'brand' => null], 200);
        }
        $brand->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $brand], 200);
    }

    /* lay du lieu len frontend */
    public function brand_list($parent_id = 0, $status = 1)
    {
        $args = [
            ['status', '=', $status]
        ];
        $data = Brand::where($args)->orderBy('sort_order', 'ASC')->get();
        return response()->json($data, 200);
    }
}