<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Support\Facades\Request;

class TrackController
{
    public function increaseListenings($id)
    {
        $track = Track::find($id, 'ID_tracks');

        if (!$track) {
            return response()->json(['message' => 'Трек не найден'], 404);
        }
        $track->increment('countOfListenings');
        return response()->json(['message' => 'Счетчик прослушиваний увеличен']);
    }



}
