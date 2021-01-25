@extends('layouts.app')
@section('title')
    Vous avez recherché "{{$datasearch}}"
@endsection
@section('content')
<div class="container mt-4 mb-5" >
   
    <div class="col-md-12">
        
        <div class="justify-content-center text-center">
            <h2 class="font-weight-bold">Recherche</h2>
        </div>
        <div class="row">
            @foreach ($datas as $data)
                <div class="col-sm-6 col-md-4">
                    <div class="img-thumbnail">
                        <div class="caption text-center">
                            <h3 class="font-weight-bold">{{ $data->Nom_artc }}</h3>
                        </div>
                    </div>
                </div>    
            @endforeach  
        </div>
        @if($datas->isEmpty())
            <div class="justify-content-center text-center impty">
                <h2><b>Aucun resultats trouvé</b></h2>
                <a href="{{ url('dash') }}">Retour</a>
            </div>
        @endif
    </div>
    
</div>
<div class="d-flex justify-content-center">
    {{$datas->links()}}
</div>
@endsection
    