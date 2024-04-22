<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Musician
{
    public function index() {
        $musicians = DB::table('musicians')->get();

        return view('musician', ['musicians' => $musicians]);
    }
}
