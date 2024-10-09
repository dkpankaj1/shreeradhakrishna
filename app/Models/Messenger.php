<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'wa_template_id',
        'attachment',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function waTemplate()
    {
        return $this->belongsTo(WaTemplate::class);
    }
}
