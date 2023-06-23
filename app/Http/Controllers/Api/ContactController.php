<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    /*lay danh sach*/
    public function index()
    {
        $contact = Contact::all();
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'contact' => $contact], 200);
    }

    /*lay bang id -> chi tiet */
    public function show($id)
    {
        $contact = Contact::find($id);
        return response()->json(['success' => true, 'message' => "Tải dữ liệu thành công", 'contact' => $contact], 200);
    }

    /* them */
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->user_id = $request->user_id; //form
        $contact->name = $request->name; //form
        $contact->email = $request->email; //form
        $contact->phone = $request->phone; //form
        $contact->title = $request->title; //form
        $contact->content = $request->content; //form
        $contact->replay_id = $request->replay_id; //form
        $contact->created_at = date('Y-m-d H:i:s');
        $contact->created_by = 1;
        $contact->status = $request->status; //form
        $contact->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'data' => $contact], 201);
    }

    /*update*/
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->user_id = $request->user_id; //form
        $contact->name = $request->name; //form
        $contact->email = $request->email; //form
        $contact->phone = $request->phone; //form
        $contact->title = $request->title; //form
        $contact->content = $request->content; //form
        $contact->replay_id = $request->replay_id; //form
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = 1;
        $contact->status = $request->status; //form
        $contact->save(); //Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'contact' => $contact], 200);
    }

    /* xoa */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if($contact == null){
            return response()->json(['success' => true, 'message' => 'Xóa không thành công', 'contact' => null], 200);
        }
        $contact->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'id' => $contact], 200);
    }

    /* lay du lieu len frontend */
    public function contact_list($user_id = 1, $status = 1)
    {
        $args = [
            ['user_id', '=', $user_id],
            ['status', '=', $status]
        ];
        $data = Contact::where($args)->orderBy('sort_order', 'ASC')->get();
        return response()->json($data, 200);
    }
}