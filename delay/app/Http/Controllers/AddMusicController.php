<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Musician;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'track_name' => 'required|string|max:255',
            'Track_icon' => 'required|file|mimes:png|dimensions:width=3000,height=3000',
            'Track_url' => 'required|file|mimes:wav|duration_max:600',
        ]);

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
            $track->save();

            return response()->json(['message' => 'Трек успешно загружен']);
        } else {
            return response()->json(['message' => 'Музыкант не найден']);
        }
    }


    public function show()
    {
        if (Session::has('user') && Session::get('user')->Status == 'musician') {
            return view('musician/single');
        } else {
            return back();
        }
    }

//    public function storeAlbum(Request $request)
//    {
//        dd($request->all());
//        $listener = Session::get('user');
//        $musician = Musician::where('ID_listeners', $listener->ID_listeners)->first();
//
//        $album = new Album;
//        $album->ID_musician = $musician->ID_musician;
//        $album->Album_name = $request->album_track;
//        $album->Album_icon = $request->file('Album_icon')->store('icons');
//        $album->Release_date = now();
//        $album->save();
//
//        foreach ($request->file('tracks') as $index => $trackFile) {
//            $track = new Track;
//            $track->ID_musician = $musician->ID_musician;
//            $track->ID_genre = $request->input('genres')[$index];
//            $track->Track_name = $request->input('track_names')[$index];
//            $track->Track_icon = $album->Album_icon;
//            $track->Track_url = $trackFile->store('tracks');
//            $track->Release_date = now();
//            $track->ID_album = $album->ID_album;
//            $track->save();
//        }
//
//        return response()->json(['success' => 'Альбом и треки успешно добавлены!']);
//    }

}
//        $request->validate([
//            'album_track' => 'required|string',
//            'Track_url' => 'required|image|mimes:png|dimensions:min_width=2000,min_height=2000',
//            'tracks.*.Track_url' => 'required|file|mimes:wav',
//            'tracks.*.track_name' => 'required|string',
//            'tracks.*.genre' => 'required|exists:genres,ID_genre',
//        ]);

//        dd($request);
//        $request->validate([
//            'ID_genre' => 'required|exists:genres,ID_genre',
//            'Track_name' => 'required|max:255',
//            'Track_icon' => 'required|mimes:png|dimensions:max_width=3000,max_height=3000',
//            'Track_url' => 'required|mimes:wav',
//            'Release_date' => 'required|date',
//        ]);
