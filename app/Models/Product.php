<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'special',
        'preserve',
        'quantity',
        'category_id',
        'status',
    ];
        /**
     * order
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function order()
    {
        return $this->hasMany(order::class, 'product_id');
    }
    
    
    
}
