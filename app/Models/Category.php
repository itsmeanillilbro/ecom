<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'is_active'
    ];


    public function products(){
        return $this->hasMany(Product::class);
    }

    public function delete()
    {
        if (!empty($this->image)) {
            Storage::disk('public')->delete($this->image);
        }
        parent::delete();
    }
}
