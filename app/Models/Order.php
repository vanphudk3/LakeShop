<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';


    /**
     * product
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * transaction
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(){
        return $this->belongsTo(transaction::class, 'transaction_id');
    }
}
