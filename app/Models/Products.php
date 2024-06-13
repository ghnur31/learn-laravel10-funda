<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'small_description',
        'original_price',
        'price',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'date' => 'date',
        'end_date' => 'datetime:Y-m-d',
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'name_price'
    ];


    public function getNamePriceAttribute()
    {
        return $this->name . ' - ' . $this->price;
    }

    public function getNameAttribute()
    {
        return ucfirst($this->attributes['name']);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
