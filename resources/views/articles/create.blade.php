@extends('layouts.app')
@section('title')
    Ajouter l'article
@endsection

@section('content')
<div class="container mt-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Création d'une article</h1>
    </div>
    <div class="col-md-8 offset-2">
    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group ">
                <label for="inputEmail4">Nom article(*)</label>
                <input type="text" name="nomArtcl" class="form-control" id="inputnomart" value="{{ old('nomArtcl' , $article->Nom_artc ?? null) }}">
                @if ($errors->get('nomArtcl'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('nomArtcl') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="categorie" class=" control-label">Categorie(*)</label>
                  <select name="categorie" id="categorie" class="form-control">
                    <option value=""></option>
                      @foreach($categories as $categorie)
                          <option value="{{ $categorie->id }}">{{ $categorie->Nom_Cat }}</option>
                      @endforeach
                  </select>
                  <div><a style="text-decoration: none" href="{{route('categories.create')}}">+ Ajouter une nouvelle categorie</a></div>
                  @if ($errors->get('categorie'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('categorie') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
              <div class="form-group col-md-6">
                <label for="fournisseur" class=" control-label">Fournisseur(*)</label>
                <select name="fournisseur" id="fournisseur" class="form-control">
                  <option value=""></option>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->Nom_fourn }}</option>
                    @endforeach
                    
                </select>
                <div><a style="text-decoration: none" href="{{route('fournisseurs.create')}}">+ Ajouter une nouveau fournisseur</a></div>
                @if ($errors->get('fournisseur'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('fournisseur') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
              </div>
            </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Prix d'achat(*)</label>
                  <input type="text" name="prixachat" class="form-control" id="inputprix" value="{{ old('prixachat' , $article->Prix_achat ?? null) }}">
                  @if ($errors->get('prixachat'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('prixachat') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif
                </div>
                <div class="form-group col-md-6 @if($errors->get('prixvente')) has-error @endif" >
                  <label for="inputAddress">Prix de vente(*)</label>
                  <input type="text" name="prixvente" class="form-control" id="inputprix"  value="{{ old('prixvente' , $article->Prix_de_vente ?? null) }}"--}}>
                  @if ($errors->get('prixvente'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('prixvente') as $error)
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
