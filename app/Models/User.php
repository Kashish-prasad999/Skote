<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use  HasFactory, Notifiable, HasRoles;
    
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function product(){
        return $this->hasMany(Product::class,'seller_id');
    }


    // public function ordersToCount()
    // {
    //   return $this->hasManyThrough(Order::class, Product::class
    //     ->wherePivot('user_id', $this->id)
    //     ->whereNotNull('product_id')
    //   );
    // }

    // public function orders(){
    //     return $this->hasManyThrough(
    //     Order::class,
    //     OrderItem::class,
    //     Product::class,
    //     'id',
    //     'id',
    //     'order_id',
    //     'id',
    //     'user_id'
    //   )
    //   ->where('order_date', '>=', now()->subMonths(6));
    // }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function productWithOrder()
    {
      return $this->belongsToMany(Product::class, 'orders');
    }
    public function producjkdljgjfo()
    {
      return $this->belongsToMany(Product::class, 'seller_products', 'user_id', 'product_id');
    }
}
