<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $tables = 'likes';

    protected $fillable = [
        'id',
        'postid',
        'userid'
    ];

    protected $guarded = [
        'id'
    ];
}
