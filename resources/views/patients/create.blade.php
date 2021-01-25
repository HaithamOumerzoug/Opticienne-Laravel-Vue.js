@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ajoute d'un patient</h1>
  </div>
  <div class="col-md-8 offset-2">
  <form method="POST" action="{{ route('patients.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-row"> 
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nom(*)</label>
              <input type="text" name="nom" class="form-control" id="inputnom" value="{{ old('nom' , $patient->Nom_P ?? null) }}">
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
              <label for="inputPassword4">Prénom(*)</label>
              <input type="text" name="prenom" class="form-control" id="inputprenom" value="{{ old('prenom' , $patient->Prenom_P ?? null) }}">
              @if ($errors->get('prenom'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->get('prenom') as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif 
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Telephone(*)</label>
            <input type="text" name="telephone" class="form-control" id="input" placeholder="+212" value="{{ old('telephone' , $patient->Telephone_P ?? null) }}">
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
          <button type="submit" class="btn-block btn btn-primary">Enregistrer</button>
        </form>
  </div>
  
</div>

@endsection
