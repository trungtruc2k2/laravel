<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    /*lay danh sach*/
    public function index()
    {
        $topic = Topic::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'topic' => $topic], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $topic = Topic::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'topic' => $topic], 200);
    }

    /* them */
    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->name = $request->name; //form
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->parent_id = $request->parent_id; //form
        $topic->metakey = $request->metakey; //form
        $topic->metadesc = $request->metadesc; //form
        $topic->detail = $request->detail; //form
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->created_by = 1;
        $topic->status = $request->status; //form
        $topic->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $topic], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->name = $request->name; //form
        $topic->slug = $request->slug;
        $topic->parent_id = $request->parent_id; //form
        $topic->metakey = $request->metakey; //form
        $topic->metadesc = $request->metadesc; //form
        $topic->detail = $request->detail; //form
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = 1;
        $topic->status = $request->status; //form
        $topic->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'topic' => $topic], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        if($topic == null){
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'topic' => null], 200);
        }
        $topic->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $topic], 200);
    }

    /* lay du lieu len frontend */
    public function topic_list($parent_id = 1, $status = 1)
    {
        $args = [
            ['parent_id', '=', $parent_id],
            ['status', '=', $status]
        ];
        $data = Topic::where($args)->orderBy('sort_order', 'ASC')->get();
        return response()->json($data, 200);
    }
}