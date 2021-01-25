@extends('layouts.app')
@section('title')
    Articles
@endsection
@section('content')
    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">La liste des articles</h1>
</div>
<div class="col-md-8 offset-2">
    @if(session()->has('status'))
    <div class="alert alert-success">
        {{ session()->get('status') }}
    </div>
@endif
</div>

<div class="d-flex bd-highlight mb-3">
    <div class="mr-auto p-2 "></div>
    <div class="p-2 "><a href=" {{route('articles.create')}}" class="btn btn-danger"> Ajouter un article</a></div>
    <div class="p-2  mr-4"><a class="btn btn-info" href="{{ route('listearticles') }}">Exporter</a></div>
  </div>
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">N° d'article</th>
                <th scope="col">Nom d'article</th>
                <th scope="col">Prix d'achat</th>
                <th scope="col">Prix de vente</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($arts as $art)
                    <tr>
                        <th>{{ $art->id }}</th>
                        <th>{{ $art->Nom_artc }}</th>
                        <td>{{$art->Prix_achat }} MAD</td>
                        <td>{{ $art->Prix_de_vente }} MAD</td>  
                        <td class="float-right">
                            <form method="POST" action="{{ route('articles.destroy' ,['article'=>$art->id]) }}">
                                @csrf   
                                @method('DELETE')  
                                @can('update', $art)
                                    <a href="{{route('articles.edit', ['article'=>$art->id])}}" class="btn btn-success">Modifier</a>
                                @endcan
                                @can('delete', $art)
                                        <button type="submit" role="button" class="btn btn-danger">Supprimer</button>
                                @endcan 
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection