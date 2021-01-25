@extends('layouts.app')
@section('title')
    Fournisseurs
@endsection
@section('content')
    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fournisseurs</h1>
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
    <div class="p-2 "><a href=" {{ route('fournisseurs.create')}}" class="btn btn-danger"> Ajouter un fournisseur</a></div>
    <div class="p-2  mr-4"><a class="btn btn-info" href="/listefournisseurs">Exporter</a></div>
  </div>
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">N° fournisseur</th>
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Pays</th>
                <th scope="col">ville</th>
                <th scope="col">Code Postale</th>
                <th scope="col">Telephone</th>
                <th scope="col"></th> 
              </tr>
            </thead>
            <tbody>
                @foreach ($fournisseurs as $fournisseur)
                <tr>
                    <th scope="row">{{ $fournisseur->id }}</th>
                    <td>{{ $fournisseur->Nom_fourn }}</td>
                    <td>{{ $fournisseur->Adresse_fourn }}</td>
                    <td>{{ $fournisseur->pays }}</td>
                    <td>{{ $fournisseur->ville }}</td>
                    <td>{{ $fournisseur->Codepostale }}</td>
                    <td>{{ $fournisseur->Telephone_fourn }}</td>
                    <td class="float-right">
                        <form method="POST" action="{{ route('fournisseurs.destroy' ,['fournisseur'=>$fournisseur->id]) }}">
                            @csrf   
                            @method('DELETE')
                            @can('update', $fournisseur)
                                <a href="{{route('fournisseurs.edit', ['fournisseur'=>$fournisseur->id])}}" class="btn btn-success">Modifier</a>
                            @endcan
                            @can('delete', $fournisseur)
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