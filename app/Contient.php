<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contient extends Model
{
    use SoftDeletes;
    public function commande()
    {
        return $this->belongsTo('App\Command');
    }
}
