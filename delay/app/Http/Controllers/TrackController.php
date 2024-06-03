<?php

namespace App\Http\Controllers;

use App\Models\Track;
use getID3;
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
        return response()->json();
    }

    public function showModal($id)
    {
        $track = Track::with(['musician', 'genre'])->findOrFail($id);

        $getID3 = new getID3;
        $file = $getID3->analyze(storage_path('app/public/' . $track->Track_url));

        $duration = 0;
        if (isset($file['playtime_seconds'])) {
            $duration = (int) $file['playtime_seconds'];
        }

        $response = [
            'Track_name' => $track->Track_name,
            'musician' => $track->musician,
            'genre' => $track->genre,
            'Track_duration' => $duration,
            'Play_count' => $track->countOfListenings,
            'Release_date' => $track->Release_date
        ];

        return response()->json($response);
    }

}
