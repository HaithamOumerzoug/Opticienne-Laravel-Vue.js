<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    public function articleastocks()
    {
        return $this->hasOne('App\Articleastock');
    }
}
