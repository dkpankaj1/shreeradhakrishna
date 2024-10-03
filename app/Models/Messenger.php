<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory;
    protected $fillable= [
        'send_from',
        'send_to',
        'content',
        'status',
    ];
}
