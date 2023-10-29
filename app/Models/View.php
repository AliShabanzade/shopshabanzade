<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class View extends Model
{
    use HasFactory , HasUser;

    protected $fillable= ['viewable_id', 'viewable_type', 'user_id'];

    public function viewable():MorphTo
    {
        return $this->morphTo();
    }


}
