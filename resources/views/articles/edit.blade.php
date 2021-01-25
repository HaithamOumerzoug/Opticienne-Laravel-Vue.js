@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier l'article</h1>
    </div>
    <div class="col-md-8 offset-2">
    <form method="POST" action="{{ route('articles.update',['article'=>$art->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
              <div class="form-group ">
                <label for="inputEmail4">Nom article</label>
                <input type="text" name="nomArtcl" class="form-control" id="inputnomart" value="{{ old('nomArtc' , $art->Nom_artc ?? null) }}">
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
                  <label for="categorie" class=" control-label">categorie</label>
                  <select name="categorie" id="categorie" class="form-control">
                    <option value="{{ $oldcat->id }}">{{old('categorie',$oldcat->Nom_Cat ?? null)}}</option>
                      @foreach($categories as $categorie)
                        @if($oldcat->id!=$categorie->id)
                          <option value="{{ $categorie->id }}">{{ $categorie->Nom_Cat }}</option>
                        @endif
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
                <label for="fournisseur" class=" control-label">Fournisseur</label>
                <select name="fournisseur" id="fournisseur" class="form-control">
                  <option value="{{ $oldfrn->id }}">{{old('fournisseur',$oldfrn->Nom_fourn ?? null)}}</option>
                    @foreach($fournisseurs as $fournisseur)
                      @if($fournisseur->id!=$oldfrn->id)         
                          <option value="{{ $fournisseur->id }}">{{ $fournisseur->Nom_fourn }}</option>
                      @endif
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
                  <label for="inputAddress">Prix de vente</label>
                  <input type="number" name="prixvente" class="form-control" id="inputprix"  value="{{ old('prixvente' , $art->Prix_de_vente ?? null) }}"--}}>
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
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Prix d'achat</label>
                  <input type="text" name="prixachat" class="form-control" id="inputprix" value="{{ old('prixachat' , $art->Prix_achat ?? null) }}"--}}>
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
            </div>
            
            
            <button type="submit" class="btn-block btn btn-warning">Modifier</button>
          </form>
    </div>
    
</div>


@endsection


