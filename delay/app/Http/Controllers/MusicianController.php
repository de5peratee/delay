<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MusicianController
{
    public function index() {
        return view ('/musician');
    }
}
