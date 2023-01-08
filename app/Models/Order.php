<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'orders';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'postcode'
    ];
}
