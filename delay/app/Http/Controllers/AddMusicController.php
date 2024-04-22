<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use App\Models\Track;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AddMusicController
{
    public function index()
    {
        if (Session::has('user') && Session::get('user')->Status == 'musician') {
            return view('/musician/add_music');
        } else {
            return back();
        }
    }
    public function store(Request $request)
    {
//        $request->validate([
//            'ID_genre' => 'required|exists:genres,ID_genre',
//            'Track_name' => 'required|max:255',
//            'Track_icon' => 'required|mimes:png|dimensions:max_width=3000,max_height=3000',
//            'Track_url' => 'required|mimes:wav',
//            'Release_date' => 'required|date',
//        ]);
        $listener = Session::get('user');
        $musician = Musician::where('ID_listeners', $listener->ID_listeners)->first();

        if ($musician) {
            $track = new Track;
            $track->ID_musician = $musician->ID_musician;
            $track->ID_genre = $request->genre;
            $track->Track_name = $request->track_name;
            $track->Track_icon = $request->file('Track_icon')->store('icons');
            $track->Track_url = $request->file('Track_url')->store('tracks');
            $track->Release_date = now();
            //dd($track);
            $track->save();

            return response()->json(['message' => 'Трек успешно загружен']);
        } else {
            return response()->json(['message' => 'Музыкант не найден']);
        }
    }
}
