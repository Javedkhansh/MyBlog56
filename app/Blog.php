<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Blog extends Model
{
    use softDeletes;
    //using another table in the same model
    // protected $table = 'my_blog';
    protected $dates = ['deleted_at'];
    protected $fillable = ['title','body','featured_image','slug','meta_title','meta_description','status'];



    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

