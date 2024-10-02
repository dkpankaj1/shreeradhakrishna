<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redeem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'trans_id',
        'payment_method',
        'payment_detail',
        'amt',
        'pay_amt',
        'customer_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by', 
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_redeem');
    }
}