<?php

namespace App\Http\Controllers;

use App\Article;
use App\Articleastock;
use App\Categorie;
use App\Contient;
use App\Fournisseur;
use App\Http\Requests\StoreArticle;
use App\Stock;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
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
        
        $arts=Article::OrderBy('Updated_at','desc')->get();
        
        
        return view('articles.index',['arts'=>$arts]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Categorie::OrderBy('Updated_at','desc')->get();
        $fournisseurs=Fournisseur::OrderBy('Updated_at','desc')->get();
        return view('articles.create',['fournisseurs' => $fournisseurs,'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        

        $art=new Article();
        $art->Nom_artc=$request->get('nomArtcl');
        $art->Prix_de_vente=$request->get('prixvente');
        $art->Prix_achat=$request->get('prixachat');
        $art->categorie_id=$request->get('categorie');
        $art->fournisseur_id=$request->input('fournisseur');
        $request->session()->flash('status','Votre article à été enregitrer!');
        $art->save();
  
        return redirect()->route('articles.index');
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
        $art=Article::findOrFail($id);
        $this->authorize('update',$art);
        $oldfrn=Fournisseur::findOrFail($art->fournisseur_id);
        $oldcat=Categorie::findOrFail($art->categorie_id);
        
        $categories=Categorie::OrderBy('Updated_at','desc')->get();
        $fournisseurs=Fournisseur::OrderBy('Updated_at','desc')->get();
        return view('articles.edit', [
            'art'=>$art,
            'fournisseurs' => $fournisseurs,
            'categories' => $categories,
            'oldcat' => $oldcat,
            'oldfrn' => $oldfrn
            ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticle $request, $id)
    {
        $art=Article::find($id);
        $art->Nom_artc=$request->get('nomArtcl');
        $art->Prix_de_vente=$request->get('prixvente');
        $art->Prix_achat=$request->get('prixachat');
        $art->categorie_id=$request->get('categorie');
        $art->fournisseur_id=$request->get('fournisseur');
        $request->session()->flash('status','Votre article à été bien modifier!');

        $art->save();

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        
        $cnt=Contient::where('article_id',$id)->get();
        if(!$cnt->isEmpty()){
            $request->session()->flash('status','Ooops ! cette article à des commandes!');
        }
        else{
            $stks=Articleastock::where('article_id',$id)->get();
            if(!$stks->isEmpty()){
                Articleastock::where('article_id',$id)->delete();
                foreach($stks as $stk){
                Stock::where('id',$stk->stock_id)->delete();
                }
            }
            Article::destroy($id);
            $request->session()->flash('status','Article à été supprimé!'); 
        }
        
        
      
        return  redirect()->route('articles.index');
    }


    
    public function listearticles(){
        $articles=Article::OrderBy('Updated_at','desc')->get();
        $pdf = PDF::loadView('articles.listearticles',['articles'=>$articles]);
        // $date=new Date();
        return $pdf->download('ListeArticles.pdf');
        
    }
}
