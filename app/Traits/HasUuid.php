<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{


    protected static function bootHasUuid(): void
    {
        // agar bekhahim gahi function boot ra dar model estefade konim bayad
        // parent::boot ra dar trait an hazf konim , hamchenin baraye kar kardane har 2 boot bayad dar
        //trait namgozari an ra be soorate  boot+triat anjam dahim = bootHasUuid
//        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

}
