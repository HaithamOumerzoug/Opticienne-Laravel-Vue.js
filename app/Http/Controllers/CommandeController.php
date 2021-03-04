<?php

namespace App\Http\Controllers;

use App\Article;
use App\Articleastock;
use App\Commande;
use App\Contient;
use App\Http\Requests\StoreCommande;
use App\Patient;
use App\Stock;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class CommandeController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cmds=Commande::OrderBy('Updated_at','desc')->get();
        $cnts=Contient::OrderBy('Updated_at','desc')->get();
        for($i=0;$i<sizeof($cmds);$i++){
            for($j=0;$j<sizeof($cnts);$j++){
                if($cmds[$i]->id==$cnts[$j]->commande_id){
                    $cmds[$i]->Qte=$cnts[$j]->Qte;
                    $cmds[$i]->Prix_de_vente=$cnts[$j]->Prix_de_vente;
                    $arts=Article::where('id','=',$cnts[$j]->article_id)->first();
                    $cmds[$i]->nom_article=$arts->Nom_artc;
                    $pts=Patient::where('id','=',$cmds[$i]->patient_id)->first();
                    $cmds[$i]->patient=$pts->Nom_P.' '.$pts->Prenom_P;
                }
            } 
        }
        return view('commandes.index',['cmds'=>$cmds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles=Article::OrderBy('Updated_at','desc')->get();
        $patients=Patient::OrderBy('Updated_at','desc')->get();
        $vide="";
        
        return view('commandes.create',['articles'=>$articles,'patients'=>$patients,"vide"=>$vide]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(StoreCommande $request)
    {
        
        if($request->get('Qte_cmd'))
            $cmd=new Commande();
            $cmd->patient_id=$request->get('patient');
            $cmd->date_cmd=$request->get('datecmd');
            $cmd->save();
            $last_id_cmd=$cmd->id;

            $cnt=new Contient();
            $cnt->commande_id=$last_id_cmd;
            $cnt->article_id=$request->get('article');
            $art=Article::find($cnt->article_id);
            $cnt->Qte=$request->get('Qte_cmd');
            $cnt->Prix_de_vente=$art->Prix_de_vente* $cnt->Qte;
           
            $request->session()->flash('status','Votre commande(s) à été bien enregitrer!');
            $cnt->save();

            return response()->json(['etat'=>true]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cmd=Commande::find($id);
        $cnt=DB::table('contients')
                ->join('commandes','commande_id','=','commandes.id')
                ->where('commande_id','=',$id)
                ->select('contients.*')
                ->first();
        if($cmd->patient_id!=""){
            $pt=Patient::find($cmd->patient_id);     
        }
        if($cnt->article_id!=""){
            $oldart=Article::find($cnt->article_id);
        }
        

        $cmd->Qte=$cnt->Qte;
        $cmd->Prix_de_vente=$cnt->Prix_de_vente;
        
        $patients=Patient::where('id','!=',$pt->id,'and','deleted_at','=',NULL)->get();

        $articles=Article::where('id','!=',$oldart->id,'and','deleted_at','=',NULL)->get();
        
        return view('commandes.editcmd',[
            'cmd'=>$cmd,
            'oldart'=>$oldart,
            'articles'=>$articles,
            'pt'=>$pt,
            'patients'=>$patients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommande $request, $id)
    {
        $cmd=Commande::find($id);
        $cmd->patient_id=$request->get('patient');
        $cmd->date_cmd=$request->get('datecmd');
        $cmd->save();
        $art=Article::find($request->get('article'));
        DB::table('contients')
            ->join('commandes','commande_id','=','commandes.id')
            ->where('commande_id','=',$cmd->id)
            ->update(['Qte' => $request->get('Qte_cmd'), 'Prix_de_vente' => $request->get('Qte_cmd')*$art->Prix_de_vente, 'article_id' => $art->id]);

        $request->session()->flash('status','Votre commade à été bien modifier!');
        

        return redirect()->route('commandes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Contient::where('commande_id',$id)->delete();
        Commande::destroy($id);
        $request->session()->flash('status','La commande à été supprimé!'); 
      
        return  redirect()->route('commandes.index');
    }
    
    public function getcommandes(){

        $cmds=Commande::whereDate('created_at', '>', Carbon::now()->subDays(2))->get();
        /*$cmds=Commande::whereBetween('date_cmd', [
            Carbon::now()->subdays(30)->format('Y-m-d'),
            Carbon::now()->subday()->format('Y-m-d')
         ])->get();*/
        $cnts=Contient::whereDate('created_at', '>', Carbon::now()->subDays(2))->get();
        for($i=0;$i<sizeof($cmds);$i++){
            for($j=0;$j<sizeof($cnts);$j++){
                if($cmds[$i]->id==$cnts[$j]->commande_id){
                    $cmds[$i]->Qte=$cnts[$j]->Qte;
                    $cmds[$i]->article=Article::find($cnts[$j]->article_id)->Nom_artc;
                    $cmds[$i]->Prix_de_vente=$cnts[$j]->Prix_de_vente;
                    $cmds[$i]->patient=Patient::find($cmds[$i]->patient_id)->Nom_P.' '.Patient::find($cmds[$i]->patient_id)->Prenom_P;
                }
            }  
        }

        return $cmds;
        
    }
    
    public function getprice(Request $request ){
        $art=Article::find($request->article);
        $qte=$request->Qte;
        $price=$art->Prix_de_vente*$qte;
        
        return $price;

    }
    public function listecommades(){
        $cmds=Commande::OrderBy('Updated_at','desc')->get();
        $cnts=Contient::OrderBy('Updated_at','desc')->get();
        for($i=0;$i<sizeof($cmds);$i++){
            for($j=0;$j<sizeof($cnts);$j++){
                if($cmds[$i]->id==$cnts[$j]->commande_id){
                    $cmds[$i]->Qte=$cnts[$j]->Qte;
                    $cmds[$i]->Prix_de_vente=$cnts[$j]->Prix_de_vente;
                    $arts=Article::where('id','=',$cnts[$i]->article_id)->first();
                    $cmds[$i]->nom_article=$arts->Nom_artc;
                    $pts=Patient::where('id','=',$cmds[$i]->patient_id)->first();
                    $cmds[$i]->patient=$pts->Nom_P.' '.$pts->Prenom_P;
                }
            } 
        }
        $pdf = PDF::loadView('commandes.listecommandes',['cmds'=>$cmds]);
        return $pdf->download('ListeCommandes.pdf');
        
    }
}
