@extends('layouts.app')
@section('title')
    Patients
@endsection
@section('content')
    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Patients</h1>
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
    <div class="p-2 "><a href=" {{ route('patients.create')}}" class="btn btn-danger"> Ajouter un patient</a></div>
    <div class="p-2  mr-4"><a class="btn btn-info" href="/listepatients">Exporter</a></div>
  </div>
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">N° patient</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Telephone</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                <tr>
                    <th scope="row">{{ $patient->id }}</th>
                    <td>{{ $patient->Nom_P }}</td>
                    <td>{{ $patient->Prenom_P }}</td>
                    <td>{{ $patient->Telephone_P }}</td>
                    <td class="float-right">
                        <form method="POST" action="{{ route('patients.destroy' ,['patient'=>$patient->id]) }}">
                            @csrf   
                            @method('DELETE')  
                                  <div class="p-2  mr-4">
                                    @can('update', $patient)
                                    <a href="{{route('patients.edit', ['patient'=>$patient->id])}}" class="btn btn-success">Modifier</a>
                                    @endcan
                                    @can('delete', $patient)
                                        <button type="submit" role="button" class="btn btn-danger">Supprimer</button>
                                    @endcan 
                                       
                                </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection