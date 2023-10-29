<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory , HasUser;

    protected $fillable= ['user_id', 'code', 'total'];



    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function payment():HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
