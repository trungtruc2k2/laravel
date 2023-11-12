<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /*lay danh sach*/
    public function index()
    {
        $post = Post::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'post' => $post], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'post' => $post], 200);
    }

    public function getPostsByType($type)
    {
        // Lấy danh sách bài viết dựa trên type
        $posts = Post::where('type', $type)->get();
        // Trả về danh sách bài viết
        return response()->json(['posts' => $posts]);
    }

    /* them */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'detail' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $slug = Str::slug($request->input('title'));
        // Kiểm tra nếu slug đã tồn tại
        $count = Post::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . time(); // Thêm timestamp vào slug để đảm bảo tính duy nhất
        }
        $post = new Post();
        $post->topic_id = $request->topic_id; //form
        $post->title = $request->title; //form
        $post->slug = $slug;
        $post->detail = $request->detail; //form
        //upload hình ảnh
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $post->slug . '.' . $extension;
                $post->image = $filename;
                $files->move(public_path('images/post'), $filename);
            }
        }
        //
        $post->type = $request->type; //form
        $post->metakey = $request->metakey; //form
        $post->metadesc = $request->metadesc; //form
        $post->created_at = date('Y-m-d H:i:s');
        $post->created_by = 1;
        $post->status = $request->status; //form
        $post->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $post], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->topic_id = $request->topic_id; //form
        $post->title = $request->title; //form
        $post->slug = $request->slug; //form
        $post->detail = $request->detail; //form
        //upload hình ảnh
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $post->slug . '.' . $extension;
                $post->image = $filename;
                $files->move(public_path('images/post'), $filename);
            }
        }
        //
        $post->type = $request->type; //form
        $post->metakey = $request->metakey; //form
        $post->metadesc = $request->metadesc; //form
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = 1;
        $post->status = $request->status; //form
        $post->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'post' => $post], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'post' => null], 200);
        }
        $post->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $post], 200);
    }

    /* lay du lieu len frontend */
    public function post_list($topic_id = 1, $status = 1)
    {
        $args = [
            ['topic_id', '=', $topic_id],
            ['status', '=', $status]
        ];
        $data = Post::where($args)->orderBy('sort_order', 'ASC')->get();
        return response()->json($data, 200);
    }
}
