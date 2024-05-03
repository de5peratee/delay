<?php

namespace App\Http\Controllers;

use App\Models\Track;

class PopularController
{
    public function index()
    {
        $tracks = Track::getTracksSortedByListening();

        return view('/popular', ['tracks' => $tracks]);
    }
}
