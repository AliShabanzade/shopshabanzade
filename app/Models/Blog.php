<?php

namespace App\Models;

use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasMedia;
use App\Traits\HasUser;
use App\Traits\HasUuid;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory , HasUser ,SoftDeletes, HasMedia , HasLike , HasComment , HasView , HasUuid;

    protected $fillable = ['uuid', 'user_id', 'title', 'body', 'published'];








}
