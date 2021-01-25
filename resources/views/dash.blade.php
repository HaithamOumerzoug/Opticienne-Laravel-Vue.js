@extends('layouts.app')
@section('title')
    Tableau de bord
@endsection
@section('content')
    

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="container my-5 " id="app">
  <button type="button" v-on:click="getcommandes" class="btn btn-primary float-right">
    Nouvelles commandes
    <span class="badge badge-light">@{{c}}</span>
  </button>
  <div class="notification">
    <div class="" v-for="(allCommande) in allCommandes" id="box">
      <div class="notifications-item">
          <div class="text">
            <h4>Commande N°@{{allCommande.id}}</h4>
          <p>Le patient '@{{allCommande.patient}}' a commandé @{{allCommande.Qte}} d'article @{{allCommande.article}} au date @{{allCommande.datecmd}} au montant @{{allCommande.price}} MAD</p>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection