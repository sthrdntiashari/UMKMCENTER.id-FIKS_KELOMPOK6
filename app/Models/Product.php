<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini
use App\Models\Category;
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 
        'category_id',
        'name',
        'description',
        'price',
        'image_url',
        'ecommerce_link',
        'status', 
         'rejection_note',
    ];

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo 
    {
        return $this->belongsTo(Category::class);
    }
}