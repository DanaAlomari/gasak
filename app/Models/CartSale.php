<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartSale extends Model
{
    use HasFactory;

    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = 'cart_sales';
    protected $fillable = [
        'user_id',
        'product_count',
        'total',
        'email',
        'phone',
        'name',
        'address',
        'more_info',
    ];


    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================


    // Relation With CartOperation Model
    public function cartOperations()
    {
        return $this->hasMany(CartOperation::class,'cart_sale_id');
    }

    // ===================================================================================================================
    // ============================================= Accessors Section ===================================================
    // ===================================================================================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Pendding';
        } elseif ($value == 2) {
            return 'Accepted';
        } elseif ($value == 3) {
            return 'Rejected';
        }
    }

}
