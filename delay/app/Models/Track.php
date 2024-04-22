<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'tracks';

    protected $fillable = ['ID_musician', 'ID_genre', 'Track_name', 'Track_icon', 'Track_url', 'Release_date'];
}

