<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_musician';

    protected $fillable = ['ID_listeners', 'Musician_name', 'Musician_icon', 'Musician_description'];
}
