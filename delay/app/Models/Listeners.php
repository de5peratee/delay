<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listeners extends Model implements Authenticatable {
    use HasFactory, \Illuminate\Auth\Authenticatable;

    protected $table = 'listeners';
    protected $primaryKey = 'ID_listeners';
    protected $fillable = ['Login', 'Password', 'Personal_information', 'Status'];
    public function playlist()
    {
        return $this->hasMany(Playlist::class, 'ID_listeners');
    }
}

