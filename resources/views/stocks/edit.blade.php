@extends('layouts.app')
@section('title')
    Modifier un stock
@endsection
 
@section('content')
<div class="container mt-5" >
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modification d'un stock</h1>
    </div>        
    <div class="col-md-8  offset-2">
        <div class="container my-3">
            <form method="POST" action="{{ route('stocks.update',['stock'=>$stock->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row mt-4">
                    <div class="form-group col-md-6">
                        <label for="article"  class=" control-label">Article</label>
                        <select name="article" id="article" class="form-control">
                            <option value="{{$oldart->id}}">{{ $oldart->Nom_artc }}</option>
                            @foreach($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->Nom_artc }}</option>
                            @endforeach
                        </select>
                        @if ($errors->get('article'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('article') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Qte stocker</label>
                        <input type="number" name="Qte" class="form-control" id="inputprix" value="{{ old('Qte' , $stock->Qte_stock ?? null) }}">
                    </div>
                </div>
                <button type="submit" class="btn-block btn btn-warning">Modifier</button>
            </form>
        </div>
</div>

@endsection

