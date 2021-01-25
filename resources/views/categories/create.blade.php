@extends('layouts.app')
@section('title')
    l'ajoute d'une categorie
@endsection

@section('content')
<div class="container mt-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajoute une categorie</h1>
    </div>
    <div class="col-md-8 offset-2">
    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group ">
              <label for="inputEmail4">Nom categorie</label>
              <input type="text" name="nomcat" class="form-control" id="inputnomart" value="{{ old('nomcat' , $cat->Nom_Cat ?? null) }}">
              @if ($errors->get('nomcat'))
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->get('nomcat') as $error)
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
