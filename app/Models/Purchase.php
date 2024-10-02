<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'trans_id',
        'product',
        'volume',
        'amt',
        'reward',
        'isredeem',
        'customer_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function customer()
    {
        $this->belongsTo(Customer::class);
    }
    public function redeems(){
        return $this->belongsToMany(Redeem::class,'purchase_redeem');
    }

}