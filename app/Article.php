<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;;
class Article extends Model
{
    use SoftDeletes;
    protected $fillable=['Nom_artc','Prix_de_vente','Prix_achat'];

    public function categorie(){
        return $this->belongsTo('App\Categorie');
    } 
    public function fournisseur(){
        return $this->belongsTo('App\Fournisseur');
    } 
    public function commande()
    {
        return $this->hasMany('App\Commande');
    }
    public function articleastocks()
    {
        return $this->hasMany('App\Articleastock');
    }
    
}
