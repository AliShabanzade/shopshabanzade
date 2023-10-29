<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory , HasUuid , HasUser;

    protected $fillable= ['uuid', 'user_id', 'product_id', 'quantity'];


    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
