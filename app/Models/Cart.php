<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "cart";
    protected $fillable = [
        'item_id',
        'user_id'
    ];

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
