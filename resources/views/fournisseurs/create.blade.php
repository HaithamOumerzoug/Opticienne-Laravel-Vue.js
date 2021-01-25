@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Ajouter un fournisseur</h1>
  </div>
  <div class="col-md-8 offset-2">
  <form method="POST" action="{{ route('fournisseurs.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nom(*)</label>
              <input type="text" name="nom" class="form-control" id="inputnom" value="{{ old('nom' , $fournisseur->Nom_fourn ?? null) }}">
              @if ($errors->get('nom'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->get('nom') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Adresse(*)</label>
              <input type="text" name="adresse" class="form-control" id="inputadresse" value="{{ old('adresse' , $fournisseur->Adresse_fourn ?? null) }}">
              @if ($errors->get('adresse'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->get('adresse') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPassword4">Pays(*)</label>
              <input type="text" name="pays" class="form-control" id="inputpays" value="{{ old('pays' , $fournisseur->pays ?? null) }}">
              @if ($errors->get('pays'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->get('pays') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Ville(*)</label>
              <input type="text" name="ville" class="form-control" id="inputville" value="{{ old('ville' , $fournisseur->ville ?? null) }}">
              @if ($errors->get('ville'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->get('ville') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          </div>
          <div class="form-row ">
            <div class="form-group col-md-6">
              <label for="inputAddress">Code postale(*)</label>
              <input type="text" name="codepostale" class="form-control" id="inputcode"  value="{{ old('codepostale' , $fournisseur->Codepostale ?? null) }}">
              @if ($errors->get('codepostale'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->get('codepostale') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress">Telephone(*)</label>
                <input type="text" name="telephone" class="form-control" id="inputphone" placeholder="+212" value="{{ old('telephone' , $fournisseur->Telephone_fourn ?? null) }}">
                @if ($errors->get('telephone'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->get('telephone') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          </div>
            
          <button type="submit" class="btn-block btn btn-primary">Enregistrer</button>
        </form>
  </div>
  
</div>

@endsection
