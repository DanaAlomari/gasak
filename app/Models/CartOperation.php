<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartOperation extends Model
{
    use HasFactory;

    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = 'cart_operations';
    protected $fillable = [
        'cart_sale_id',
        'product_id',
        'quantity',
    ];

    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================
    // Relation With CartSale Model
    public function cartSale()
    {
        return $this->belongsTo(CartSale::class);
    }

    // Relation With Product Model
    public function product()
    {
      return $this->belongsTo(Product::class,'product_id');

    }
}
