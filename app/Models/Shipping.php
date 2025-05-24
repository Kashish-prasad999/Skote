<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shipping';
    protected $primarykey = 'id';
    protected $fillable = [
        'address',
        'state',
        'city',
        'zipcode',
        'notes'
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
 
   
    public function statess()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
}
