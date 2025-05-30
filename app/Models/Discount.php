<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    protected $primarykey = 'id';
    protected $fillable = ['percentage'];

    public function product()
    {
        return $this->belongsTo(Discount::class);
    }
}
