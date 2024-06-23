<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'is_stock',
        'is_sale'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function order_items()
    {
        return $this->hasMany(Orderitem::class);
    }

    public function delete()
    {
        if (!empty($this->images)) {
            Storage::disk('public')->delete($this->images);
        }
        parent::delete();
    }


}
