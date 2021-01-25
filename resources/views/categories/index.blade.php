@extends('layouts.app')
@section('title')
    Categories
@endsection
@section('content')
    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
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
    <div class="p-2 "><a href=" {{route('categories.create')}}" class="btn btn-danger"> Ajouter une categorie</a></div>
    <div class="p-2  mr-4"><a class="btn btn-info" href="">Exporter</a></div>
  </div>
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">N° de categorie</th>
                <th scope="col">Nom de categorie</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cats as $cat)
                    <tr>
                        <th>{{ $cat->id }}</th>
                        <th>{{ $cat->Nom_Cat }}</th>
                        <td class="float-right">
                            <form method="POST" action="{{ route('categories.destroy' ,['category'=> $cat->id]) }}">
                                @csrf   
                                @method('DELETE')  
                                @can('delete', $cat)
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