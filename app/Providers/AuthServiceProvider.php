<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
         'App\Fournisseur' => 'App\Policies\FournisseurPolicy',
         'App\Article' => 'App\Policies\ArticlePolicy',
         'App\Patient' => 'App\Policies\PatientPolicy',
         'App\Commande' => 'App\Policies\CommandePolicy',
         'App\Stock' => 'App\Policies\StockPolicy',
         'App\Categorie' => 'App\Policies\CategoriePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
