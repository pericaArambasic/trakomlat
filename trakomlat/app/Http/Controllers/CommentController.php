<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $comment = new Comment;
        //lol
        $comment->content = $request->body;
        $comment->video = $request->video;
        $comment->author = $request->author;
        $comment->save();

        return response()->json([
            "message" => "comment added"
        ],201);
    }

    public function editComment(Request $request, $id)
    {
        $comment = Comment::where('id', $id);
        $comment->content = $request->body;
        $comment->edited = 1;
        $comment->save();

        return response()->json([
           "message" => "comment edited"
        ]);
    }

    public function deleteComment($id)
    {
        $comment = Comment::where('id', $id);
        $comment->content = '*DELETED*';
        $comment->deleted = 1;
        $comment->save();

        return response()->json([
            "message" => "comment deleted"
        ],201);
    }
}
