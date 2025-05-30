<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'category';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
    ];

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
