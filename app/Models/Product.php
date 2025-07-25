<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'stock', 'price', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
}