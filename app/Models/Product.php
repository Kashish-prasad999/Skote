<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table= 'product';
    protected $primarykey='product_id';
    protected $fillable=[
        'product_name',
        'price',
        'image',
        'quantity'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function discountss()
    {
        return $this->belongsTo(Discount::class, 'discount', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function pictures()
    {
        return $this->hasMany(ProductImage::class);
    }
}
