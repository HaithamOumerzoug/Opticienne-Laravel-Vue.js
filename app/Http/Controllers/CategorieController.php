<?php

namespace App\Http\Controllers;

use App\Article;
use App\Categorie;
use App\Http\Requests\StoreCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats=Categorie::OrderBy('Updated_at','desc')->get();
        return view('categories.index',['cats'=>$cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategorie $request)
    {
        $cat=new Categorie();
        $cat->id=$request->get('id');
        $cat->Nom_Cat=$request->get('nomcat');
        $request->session()->flash('status','Votre categorie à été enregitrer!');
        $cat->save();

        return redirect()->action('CategorieController@index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        $cat=Categorie::findOrFail($id);
        
        $art=Article::where('categorie_id',$id)->get();
        
        // $this->authorize('delete',$categorie);
                
        if($art->isEmpty()){
            Categorie::destroy($id);
            $request->session()->flash('status','Votre categorie à été bien supprimé!');        
        }
        
        else {
            $request->session()->flash('status','Ooops ! Votre categorie à des articles!');
        }
        return  redirect()->route('categories.index');
    
    }
}
