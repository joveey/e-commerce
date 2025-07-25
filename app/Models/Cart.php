<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CartItem;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    // Relasi: cart milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: cart punya banyak item
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
