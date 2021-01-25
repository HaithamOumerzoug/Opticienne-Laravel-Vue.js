@extends('layouts.app')
@section('title')
    Commandes
@endsection 

@section('content')
    
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Commandes</h1>
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
    <div class="p-2 "><a href=" {{ route('commandes.create')}}" class="btn btn-danger"> Créer une commande</a></div>
    <div class="p-2  mr-4"><a class="btn btn-info" href="{{ route('listecommades') }}">Exporter</a></div>
  </div>
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">N° de commande</th>
                <th scope="col">Patient</th>
                <th scope="col">Article</th>
                <th scope="col">Date</th>
                <th scope="col">Qte demander</th>
                <th scope="col">Montant</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cmds as $cmd)
                    <tr>
                        <td>{{ $cmd->id }}</td>
                        <td>{{ $cmd->patient }}</td>
                        <td>{{ $cmd->nom_article }}</td>
                        <td>{{\Carbon\Carbon::parse($cmd->date_comm)->format('d/m/y')  }}</td> 
                        <td>{{ $cmd->Qte }}</td> 
                        <td>{{$cmd->Prix_de_vente." MAD"}}</td>
                        <td class="float-right">
                            <form method="POST" action="{{ route('commandes.destroy' ,['commande'=>$cmd->id]) }}"> 
                                @csrf   
                                @method('DELETE') 
                                @can('update', $cmd) 
                                    <a href="{{route('commandes.edit', ['commande'=>$cmd->id])}}" class="btn btn-success">Modifier</a>
                                @endcan
                                @can('delete', $cmd)
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

