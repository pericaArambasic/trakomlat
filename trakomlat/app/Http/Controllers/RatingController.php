<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        $rating = new Rating;
        $rating->rating = $request->rating;
        $rating->video = $request->video;
        $rating->user = $request->user;
        $rating->save();

        return response()->json([
            "message" => "rating added"
        ],201);
    }

    public function changeRating(Request $request, $id)
    {
        $rating = Rating::where('id',$id);
    }
}
