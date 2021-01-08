<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Post extends Model
{
    use Commentable;
    use HasFactory;
    protected $fillable=[
        'name',
        'text',
        'image'
    ];
    public function getPosts(){
        return Post::all();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
