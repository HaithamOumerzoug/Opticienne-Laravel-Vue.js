<?php

namespace App;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;
    protected $fillable=['patient','article','datecmd','Qte_cmd'];
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    public function contient()
    {
        return $this->hasOne('App\Contient');
    }
    public function article(){
        return $this->belongsTo('App\Article');
    } 
    /*public static function boot(){ //une fois on supprime une commande , ces contient aussi vons spprimer
        parent::boot();
        static::deleting(function(Command $command){
            $command->contient()->delete();
        });
    }*/
}
