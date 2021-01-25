@extends('layouts.app')
@section('title')
    Stocks
@endsection
@section('content')
    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">La liste des stocks</h1>
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
    <div class="p-2 "><a href="{{route('stocks.create')}}" class="btn btn-danger"> créer un stock</a></div> 
    <div class="p-2  mr-4"></div>
</div>
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">N° de stock</th>
                <th scope="col">Qte</th>
                <th scope="col">Article</th>
                <th ></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($stks as $stk)
                    <tr>
                        <td>{{ $stk->id }}</td>
                        <td>{{ $stk->Qte_stock }}</td>
                        <td>{{ $stk->nom_article }}</td>
                        <td class="float-md-right">
                            <form method="POST" action="{{ route('stocks.destroy' ,['stock'=>$stk->id]) }}">
                                @csrf   
                                @method('DELETE')
                                @can('update', $stk)  
                                    <a href="{{ route('stocks.edit',['stock'=>$stk->id]) }}" class="btn btn-success">Modifier</a>
                                @endcan
                                @can('delete', $stk)
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