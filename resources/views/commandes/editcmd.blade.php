@extends('layouts.app')

@section('content')
<div class="container mt-5"> 
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modification d'une commade</h1>
    </div>
    <div class="col-md-8 offset-2">
    <form method="POST" action="{{ route('commandes.update',['commande'=>$cmd->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fournisseur" class=" control-label">Patient</label>
                    <select name="patient" id="patient" class="form-control">
                        <option value="{{$pt->id}}">{{$pt->Nom_P." ".$pt->Prenom_P}}</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->Nom_P." ".$patient->Prenom_P }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Date de commande</label>
                    <input type="date" name="datecmd" class="form-control" id="inputdatecmd" value="{{ old('datecmd' , $cmd->date_cmd ?? null) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fournisseur" class=" control-label">Article</label>
                    <select name="article" id="article" class="form-control">
                        <option value="{{ $oldart->id }}">{{$oldart->Nom_artc}}</option>
                        @foreach($articles as $article)
                            <option value="{{ $article->id }}">{{ $article->Nom_artc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Qte</label>
                    <input type="number" name="Qte_cmd" class="form-control" id="inputqte"  value="{{$cmd->Qte }}">
                </div>
            </div>
            <button type="submit" class="btn-block btn btn-warning">Modifier</button>
          </form>
         
    
</div>


@endsection
