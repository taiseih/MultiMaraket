<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
    ];

    public function product(){
        return $this->belongsToMany(Product::class, 'carts')->withPivot(['id', 'quantity']);//中間テーブル名を変えたい時はテーブル名ごと変える)
    }

    public function likes()
    {
        return $this->belongsToMany(Product::class, 'likes')->withPivot(['user_id', 'product_id'])->withTimestamps();//中間テーブルにlikes、多対多のリレーション
    }

    public function isLike($productId)
    {
        return $this->likes()->where('product_id', $productId)->exists();
    }

    public function like($productId)
    {
        if (!$this->isLike($productId)) {
            $this->likes()->attach($productId);
        }
    }


    public function disLike($productId)
    {
        if ($this->isLike($productId)) { //いいねしていたら消す
            $this->likes()->detach($productId);
        } else {
        }
    }
}
