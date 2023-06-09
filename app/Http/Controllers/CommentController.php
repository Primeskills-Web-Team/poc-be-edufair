<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        try {
            $store = Comment::create([
                'nama' => $request->nama,
                'komentar' => $request->komentar,
                'status' => Comment::PENDING
            ]);

            return response()->json(['success' => true, "data" => $store], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, "message" => $th, "data" => null], 500);
        }
    }

    public function commentLatest(Request $request)
    {
        if ($request->per_page == null) {
            $data = Comment::latest()->get();
        } else {
            $data = Comment::latest()->get();
        }
        return response()->json(['data' => $data], 200);
        # code...
    }

    public function allComment(Request $request)
    {
        if ($request->per_page == null) {
            $data = Comment::get();
        } else {
            $data = Comment::get();
        }
        return response()->json(['data' => $data], 200);

    }

    public function getComment(Request $request)
    {
        $status = $request->status;
        $per_page = $request->per_page;
        $column = $request->sortBy;
        $sortType = $request->sortType;
        $comment_status = null;
        switch ($status) {
            case 'pending':
                $comment_status = 2;
                break;
            case 'rejected':
                $comment_status = 0;
                break;

                case 'accepted':
                    $comment_status = 1;
                    break;

            default:
                // $comment_status = 1;
                break;
        }
        return response()->json($this->orderBy($column,$sortType,$comment_status,$per_page));
    }

    public function changeStatus($id,Request $request)
    {
        $comment = Comment::findOrFail($id);
        
        try {
          $comment->update([
                'status' => $request->status
            ]);
            return response()->json(['success' => true, "data" => $comment], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, "message" => $th, "data" => null], 500);
        }
      
      
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        
        try {
          $comment->delete();
            return response()->json(['success' => true, "data" => null], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, "message" => $th, "data" => null], 500);
        }
      
      
    }

    public function orderBy($column, $sortType = 'asc',$comment_status,$per_page)
    {
        if ($column != null) {
            $data = Comment::where('status', $comment_status)->orderBy($column,$sortType)->paginate($per_page ?? 5);
            # code...
        }else {
            $data = Comment::where('status', $comment_status)->paginate($per_page ?? 5);
        }
       return $data;
    }
}
