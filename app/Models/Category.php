<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $table = "categories";
    protected $fillable = [
        'updated_by',
        'name_en',
        'description_en',
        'image',
        'status',
    ];



    public function user(){
        return $this->belongsTo(User::class,'updated_by');
    }


    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

}
