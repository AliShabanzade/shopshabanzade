<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory , HasUser , HasUuid ;

    protected $fillable = ['uuid', 'user_id', 'mediable_id', 'mediable_type', 'url', 'extension', 'size'];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
