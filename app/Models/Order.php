<?php

namespace App\Models;

use App\Traits\HasTambahan;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasTambahan;
    
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'email',
        'no_telp',
        'alamat',
        'kota',
        'provinsi',
        'negara',
        'kode_pos',
        'total_price',
        'payment_mode',
        'payment_id',
        'status',
        'message',
        'tracking_no',
    ];
    
    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
}
