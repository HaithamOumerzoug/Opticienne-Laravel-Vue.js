@extends('layouts.app')
@section('title')
    Ajouter stock
@endsection
 
@section('content')
<div class="container mt-5" >
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajoute d'un stock</h1>
    </div>
    <div class="" >
        <div class="col-md-10"></div>
        <div class="col-md-2 float-right mb-2">
            <input type="button" class="btn btn-success" v-on:click="addnewstock" value="More article">
        </div>
    </div>
        
            
    <div class="col-md-8  offset-2">
            <div class="container my-3" v-for="(stock,index) in stocks" >
                <div class="float-right" style="cursor: pointer" v-on:click="deletestockform(index)">X</div>
                <div class="form-row mt-4">

                    <div class="form-group col-md-6">
                        <label for="article"  class=" control-label">Article</label>
                        <select name="article" v-model="stock.article" id="article" class="form-control">
                            <option value=""></option>
                            @foreach($arts as $art)
                                <option value="{{ $art->id }}">{{ $art->Nom_artc }}</option>
                            @endforeach
                        </select>
                        <div><a style="text-decoration: none" href="{{route('articles.create')}}">+ Ajouter une nouvelle article</a></div>
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
                        <label for="inputPassword4">Qte à stocker</label>
                        <input type="number" min="1" v-model="stock.Qte_stk" name="Qte" class="form-control" id="inputprix" value="{{ old('Qte' , $stock->Qte_stock ?? null) }}">
                        @if ($errors->get('Qte'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('Qte') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <button type="submit" v-on:click="storeStocks" class="btn-block btn btn-primary">Enregistrer</button>
    </div>
    
</div>

@endsection

