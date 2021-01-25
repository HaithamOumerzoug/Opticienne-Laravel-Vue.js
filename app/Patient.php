<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $fillable=['Nom_P','Prenom_P','Telephone_P'];
    public function commande()
    {
        return $this->hasMany('App\Commande');
    }
    public static function boot(){ //une fois on supprime un patient , ces commandes aussi va spprimer
        parent::boot();
        static::deleting(function(Patient $patient){
            $patient->commande()->delete();
        });
    }
}
