<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watched extends Model
{
    use HasFactory;

    protected $table = 'watcheds';
    protected $primaryKey = 'id';
    protected $fillable = ['geek_id', 'movie_id'];
}
