<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'customer_id',
        'total',
        'status',
        'order_date',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

     public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product');
}}
