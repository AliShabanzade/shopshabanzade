<?php

namespace App\Models;

use App\Traits\HasComment;
use App\Traits\HasUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory , HasUser , HasUuid ;

    protected $fillable = ['uuid', 'comment', 'commentable_id', 'commentable_type', 'user_id', 'parent_id', 'published'];

    public function commentable():MorphTo
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class , 'parent_id');
    }


}
