<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderItem extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'item_id',
        'price',
    ];
}
