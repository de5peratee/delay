<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use App\Models\Track;
use Illuminate\Support\Facades\Request;

class MusicianController
{
    public function index() {
        $musicians = Musician::all();
        return view('musician', ['musicians' => $musicians]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $musicians = Musician::where('Musician_name', 'like', "%{$query}%")->get();
        $tracks = Track::where('Track_name', 'like', "%{$query}%")->get();
        return view('musician', ['musicians' => $musicians, 'tracks' => $tracks]);
    }

    public function show($musician_name)
    {
        $musician_name = urldecode($musician_name);
        $musician = Musician::where('Musician_name', $musician_name)->first();

        if (!$musician) {
            abort(404);
        }

        $tracks = Track::where('ID_musician', $musician->ID_musician)->get();

        return view('show_musician', ['musician' => $musician, 'tracks' => $tracks]);
    }
}
