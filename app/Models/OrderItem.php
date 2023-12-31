<?php

namespace App\Models;

use App\Traits\HasTambahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;
    use HasTambahan;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
    ];
   
    public function products(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
