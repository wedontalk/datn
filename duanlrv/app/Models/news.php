<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = ['id','name_post','slug','description','view','image','hidden'];



    public function scopeSearch($query)
    {
        if($key = request()->key){
            $query = $query->where('name_post','like','%'.$key.'%');
        }
        return $query;
    }
}
