<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use SoftDeletes;
    protected $fillable=['Nom_Cat'];
    public function article(){
        return $this->hasOne('App\Article');
    }
}
