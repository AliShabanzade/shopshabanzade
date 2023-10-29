<?php

namespace App\Repositories\Storage;

use App\Repositories\BaseRepositoryInterface;


interface StorageRepositoryInterface
{
    public function get($index);


    public function set($index , $value);


    public function all();


    public function exists($index);


    public function unset($index);


    public function clear();





}
