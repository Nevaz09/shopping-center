<?php

namespace App\Models;

use App\Traits\HasTambahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use HasTambahan;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty',
    ];
    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
