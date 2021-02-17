<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Music;

class MusicController extends Controller
{
    public function getAllMusic()
    {
        $music = Music::all()->toJson();
        return response($music, 200);
    }

    public function createMusic(Request $request)
    {
        $music = new Music;
        $music->name = $request->name;
        $music->link = $request->link;
        $music->save();

        return response()->json([
            "message" => "music record created"
        ], 201);
    }

    public function getMusic($id)
    {

    }

    public function updateMusic(Request $request, $id)
    {

    }

    public function deleteMusic($id)
    {

    }

}
