<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tbl_product';
    protected $fillable = [

        'product_name',
        'product_desc',
        'product_id',
        'product_slug',
        'category_id',
        'brand_id',
        'product_price',
        'product_status',
        'product_image',
    ];
}
