<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Likes;
use App\Models\Comments;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function user() {
        return $this->hasOne(User::class, 'id' , 'userid');
    }

    public function likes(){
        return $this->hasMany(Likes::class, 'postid','id');
    } 

    public function comments() {
        return $this->hasMany(Comments::class, 'commentid', 'id');
    }

    protected $fillable = [
        'title',
        'caption',
        'image',
        'userid',
        'id'
    ];

    protected $guard = [
        'id'
    ];
}
