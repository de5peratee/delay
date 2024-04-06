<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listeners extends Model{
    use HasFactory;
    protected $table = 'listeners';
    protected $fillable = ['Login', 'Password', 'Personal_information', 'Status'];
}
