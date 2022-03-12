<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMovie extends Model
{
    use HasFactory;

    protected $table = 'UserMovie';
    protected $fillable = [
        'user_id',
        'fav_movie_list',
        'watch_list',
        'rate_list',
        'comment_list'
    ];
}
