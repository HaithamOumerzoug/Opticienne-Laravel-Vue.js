<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articleastock extends Model
{
    use SoftDeletes;
    public function article(){
        return $this->belongsTo('App\Article');
    }
    public function stock(){
        return $this->belongsTo('App\Stock');
    }
}
