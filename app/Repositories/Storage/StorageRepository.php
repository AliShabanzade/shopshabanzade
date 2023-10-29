<?php

namespace App\Repositories\Storage;

use Illuminate\Session;


use Countable;



class StorageRepository  implements  StorageRepositoryInterface , Countable
{
    private $bucket;
    public function __construct( $bucket = 'default')
    {

        $this->bucket = $bucket;
    }




    public function get($index)
    {
      return session()->get($this->bucket . '.' . $index);

    }

    public function set($index, $value)
    {
       session()->put($this->bucket . '.' . $index , $value);
        return session()->all();

    }

    public function all(): array
    {
       return session($this->bucket);
//        return \session()->all();
    }

    public function exists($index)
    {
       return \session()->has($this->bucket . '.' . $index);
    }

    public function unset($index)
    {
        session()->forget($this->bucket . '.' . $index);
        return \session()->all();
    }

    public function clear()
    {
        session()->forget($this->bucket);
        return session()->all();
    }

    public function count():int
    {
//        $test = ['1','2','3'];

        return count($this->all());



    }
}
