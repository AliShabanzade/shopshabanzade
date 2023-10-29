<?php

namespace App\Models;

use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasMedia;
use App\Traits\HasUser;
use App\Traits\HasUuid;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes , HasUser , HasComment , HasMedia , HasLike , HasUuid , HasView;

    protected $fillable= ['uuid', 'user_id', 'title', 'body', 'inventory', 'published', 'price'];

    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders():BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

}
