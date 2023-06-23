<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /*lay danh sach*/
    public function index()
    {
        $slider = Slider::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'slider' => $slider], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $slider = Slider::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'slider' => $slider], 200);
    }

    /* them */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->name = $request->name; //form
        $slider->link = $request->link; //form
        $slider->sort_order = $request->sort_order; //form
        $slider->position = $request->position; //form
        $files=$request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $slider->name . '.' . $extension;
                $slider->image = $filename;
                $files->move(public_path('images/slider'), $filename);
            }
        }
        $slider->created_at = date('Y-m-d H:i:s');
        $slider->created_by = 1;
        $slider->status = $request->status; //form
        $slider->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $slider], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $slider->name = $request->name; //form
        $slider->link = $request->link; //form
        $slider->sort_order = $request->sort_order; //form
        $slider->position = $request->position; //form
        $files=$request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $slider->name . '.' . $extension;
                $slider->image = $filename;
                $files->move(public_path('images/slider'), $filename);
            }
        }
        $slider->updated_at = date('Y-m-d H:i:s');
        $slider->updated_by = 1;
        $slider->status = $request->status; //form
        $slider->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'slider' => $slider], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if ($slider == null) {
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'slider' => null], 200);
        }
        $slider->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $slider], 200);
    }

    /* lay du lieu len frontend */
    public function slider_list($position)
    {
        $args = [
            ['position', '=', $position],
            ['status', '=', 1]
        ];
        $sliders = Slider::orderBy('sort_order', 'ASC')->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'sliders' => $sliders
            ],
            200
        );
    }
}