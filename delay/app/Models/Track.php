<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'tracks';

    protected $fillable = ['ID_musician', 'ID_genre', 'Track_name', 'Track_icon', 'Track_url', 'Release_date'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'ID_genre');
    }

    public function musician()
    {
        return $this->belongsTo(Musician::class, 'ID_musician');
    }

    public static function getTracksSortedByReleaseDate()
    {
        return self::orderBy('Release_date', 'desc')->get();
    }
}
