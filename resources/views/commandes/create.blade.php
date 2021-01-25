@extends('layouts.app')

@section('content')
<div class="container mt-5" id="app">
    <add-commande></add-commande>
    <div class="">
        <div class="col-md-10"></div>
        <div class="col-md-2 float-right mb-2">
            <input type="button" class="btn btn-success" v-on:click="addnewcomande" value="More article">
        </div>
    </div>
    <div class="col-md-8 offset-2"> 
            <div class="container my-3" v-for="(commande,index) in commandes" >
                
                <div class="float-right" style="cursor: pointer" v-on:click="deletecommandeform(index)">X</div>
                <div class="form-row d-flex justify-content-center">
                    <div class="form-group col-md-12">
                        <label for="patient" class=" control-label">Patient</label>
                        <select name="patient" v-model="commande.patient" id="patient" class="form-control">
                            <option value=""></option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->Nom_P." ".$patient->Prenom_P }}</option>
                            @endforeach
                        </select>
                        <div><a style="text-decoration: none" href="{{route('patients.create')}}">+ Ajouter un nouvelle patient</a></div>
                    </div>
                    @if ($errors->get('patient'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('patient') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="article" class=" control-label">Article</label>
                        <select name="article" v-on:change="getprice"  v-model="commande.article" id="article" class="form-control">
                            <option  value="{{$vide}}"></option>
                            @foreach($articles as $article)
                                <option   value="{{ $article->id }}">{{ $article->Nom_artc }}</option>
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
                        <label for="inputPassword4">Date de commande</label>
                        <input type="date" name="datecmd" v-model="commande.datecmd" class="form-control" id="inputnomcat" {{--value="{{ old('datecmd' , $patient->Prenom_P ?? null) }}"--}}>
                        @if ($errors->get('datecmd'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('datecmd') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAddress">Qte</label>
                        <input type="number" min="1" v-on:change="getprice" v-model="commande.Qte_cmd" name="Qte_cmd" class="form-control" id="inputqte"  {{--value="{{ old('telephone' , $patient->Telephone_P ?? null) }}"--}}>
                        @if ($errors->get('Qte_cmd'))
                        <div class="alert alert-danger"> 
                            <ul>
                                @foreach ($errors->get('Qte_cmd') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="">Montant</label>
                        <div type="text" class="form-control"  name="montant">@{{commande.price}} MAD</div>
                    </div>
                </div>
            </div>
            
            <button type="submit" v-on:click="storeCommandes" class="btn-block btn btn-primary">Enregistrer</button>
        </div>
    
</div>


@endsection
