<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        "template_id",
        "template",
        "status",
        "has_param"
    ];

    public function messengers()
    {
        return $this->hasMany(Messenger::class);
    }
}
