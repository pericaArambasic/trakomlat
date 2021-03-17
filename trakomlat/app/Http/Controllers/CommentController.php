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
        $comment->content = $request->comment;
        $comment->video = $request->video;
        $comment->author = $request->author;
        $comment->save();

        return response()->json([
            "message" => "comment added"
        ],201);
    }
}
