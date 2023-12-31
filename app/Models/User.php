<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasMedia;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes , HasUuid , HasMedia , HasRoles;





    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid', 'name', 'family', 'email', 'email_verified_at', 'password', 'block', 'remember_token',
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



    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }


    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes():HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function medias():HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function views():HasMany
    {
        return $this->hasMany(View::class);
    }




    public function myLikes():HasMany
    {
        return $this->hasMany(Like::class , 'user_id' , 'id');

    }

    public function myView():HasMany
    {
        return $this->hasMany(View::class , 'user_id' , 'id');
    }

    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }









}
