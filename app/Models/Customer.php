<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "card",
        "name",
        "phone",
        "vehicle_number",
        "address",
        "city",
        "state",
        "payment_type",
        "payment_detail",
        "created_by",
        "updated_by"
    ];

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
    public function redeems(){
        return $this->hasMany(Redeem::class);
    }
}