<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class geek extends Model
{
    use HasFactory;


    protected $table = 'geeks';
    public $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password'];

}
