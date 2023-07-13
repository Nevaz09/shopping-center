<?php

namespace App\Models;

use App\Traits\HasTambahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasTambahan;
    protected $table = 'products';
    protected $fillable = [
        'id_category',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_tittle',
        'meta_keywords',
        'meta_descrip',
    ];
    public function category(){
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }
    
}
