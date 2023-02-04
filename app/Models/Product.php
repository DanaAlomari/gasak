<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name_en',
        'main_description_en',
        'sub_description_en',
        'weight',
        'sale_price',
        'quantity_limit',
        'image',
        'status',
        'updated_by',
    ];

    public function user(){
        return $this->belongsTo(User::class,'updated_by');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
