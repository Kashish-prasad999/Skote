<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primarykey = 'id';
    protected $fillable = ['name','state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

