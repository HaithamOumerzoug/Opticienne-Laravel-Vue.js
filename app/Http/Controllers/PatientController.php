<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Http\Requests\StorePatient;
use Illuminate\Http\Request;
use App\Patient;
use Barryvdh\DomPDF\Facade as PDF;

class PatientController extends Controller
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
        return view('patients.index' , ['patients' => Patient::OrderBy('Updated_at','desc')->get()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatient $request)
    {
        $patient=new Patient();
        $patient->Nom_P=$request->get('nom');
        $patient->Prenom_P=$request->get('prenom');
        $patient->Telephone_P=$request->get('telephone');

        $request->session()->flash('status','Votre patient à été enregitrer!');
        $patient->save();

        return redirect()->route('patients.index');

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
        $patient=Patient::findOrFail($id);

        return view('patients.edit', [
            'patient'=>$patient
        ]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePatient $request, $id)
    {
        $patient=Patient::findOrFail($id);
        
        $patient->Nom_P=$request->input('nom');
        $patient->Prenom_P=$request->input('prenom');
        $patient->Telephone_P=$request->input('telephone');

        $request->session()->flash('status','Votre patient à été modifier!');
        $patient->save();

        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {
        $patient=Patient::findOrFail($id);
        // $this->authorize('delete',$patient);
        $cmd=Commande::where('patient_id',$id)->get();
        if($cmd->isEmpty()){
            Patient::destroy($id);
            $request->session()->flash('status','Votre patient à été supprimé !');
        }
        else {
            $request->session()->flash('status','Ooops ! Votre patient à des commandes !');
        }
        return  redirect()->route('patients.index');
    }
    public function listepatients(){
        $patients=Patient::all();
        $pdf = PDF::loadView('patients.listepatients',['patients'=>$patients]);
        // $name='';
        return $pdf->download('ListePatients.pdf');
        }
    public function exportpatient($id){
        
        $patient=Patient::findOrFail($id);
        $pdf = PDF::loadView('patients.exportpatient',['patient'=>$patient]);
        return $pdf->download('Patient-N° '.$patient->id.'.pdf');
    }
}

