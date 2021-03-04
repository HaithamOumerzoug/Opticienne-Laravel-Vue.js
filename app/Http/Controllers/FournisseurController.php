<?php

namespace App\Http\Controllers;

use App\Article;
use App\Fournisseur;
use App\Http\Requests\StoreFournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;

class FournisseurController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fournisseurs.index' , ['fournisseurs' => Fournisseur::OrderBy('Updated_at','desc')->get()] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFournisseur $request)
    {
        $patient=new Fournisseur();
        $patient->Nom_fourn=$request->get('nom');
        $patient->Adresse_fourn=$request->get('adresse');
        $patient->pays=$request->ingetput('pays');
        $patient->ville=$request->get('ville');
        $patient->Codepostale=$request->get('codepostale');
        $patient->Telephone_fourn=$request->get('telephone');

        $request->session()->flash('status','Votre fournisseur à été enregitrer!');
        $patient->save();

        return redirect()->route('fournisseurs.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fournisseur=Fournisseur::findOrFail($id);

        return view('fournisseurs.edit', [
            'fournisseur'=>$fournisseur
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFournisseur $request, $id)
    {
        $patient=Fournisseur::findOrFail($id);
        $patient->Nom_fourn=$request->get('nom');
        $patient->Adresse_fourn=$request->input('adresse');
        $patient->pays=$request->get('pays');
        $patient->ville=$request->get('ville');
        $patient->Codepostale=$request->get('codepostale');
        $patient->Telephone_fourn=$request->get('telephone');

        $request->session()->flash('status','Votre modification à été bien enregitrer!');
        $patient->save();

        return redirect()->route('fournisseurs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $fournisseur=Fournisseur::findOrFail($id);
        $art=Article::where('fournisseur_id',$id)->get();
                
        if($art->isEmpty()){
            Fournisseur::destroy($id);
            $request->session()->flash('status','Votre fourniseurs à été supprimé!');        
        }
        
        else {
            $request->session()->flash('status','Ooops ! Votre fourniseurs à des articles!');
        }
        return  redirect()->route('fournisseurs.index');
    }
    public function listefournisseurs()
    {
        $fournisseurs=Fournisseur::all();
        $pdf = PDF::loadView('fournisseurs.listfournisseurs',['fournisseurs'=>$fournisseurs]);
        
        return $pdf->download('Liste'.' '.'Fournisseurs.pdf');
    }
}
