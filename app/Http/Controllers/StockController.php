<?php

namespace App\Http\Controllers;

use App\Article;
use App\Articleastock;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $stks=Stock::OrderBy('Updated_at','desc')->get();
        $artstks=Articleastock::OrderBy('Updated_at','desc')->get();
        for($i=0;$i<sizeof($stks);$i++){
            for($j=0;$j<sizeof($artstks);$j++){
                if($stks[$i]->id==$artstks[$j]->stock_id){
                    $arts=Article::where('id','=',$artstks[$j]->article_id)->first();
                    $stks[$i]->nom_article=$arts->Nom_artc;
                }
            }
        }
        
        return view('stocks.index',['stks'=>$stks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $arts=Article::OrderBy('Updated_at','desc')->get();
        return view('stocks.create',['arts'=>$arts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stk=new Stock();
        $stk->id=$request->get('id');
        $stk->Qte_stock=$request->get('Qte_stk');
        
        $stk->save();
        $last_id_stk=$stk->id;
        
        $stk_has_art=new Articleastock();
        $stk_has_art->article_id=$request->get('article');
        $stk_has_art->stock_id=$last_id_stk;
        
        $request->session()->flash('status','Votre stock à été bien enregitrer!');
        $stk_has_art->save();

        return response()->json(['etat'=>true]);
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
        $stock=Stock::find($id);
        $oldart_id=DB::table('articleastocks')
                    ->select('articleastocks.*')
                    ->where('stock_id',$id)
                    ->first();
        $oldart=Article::findOrFail($oldart_id->article_id);
        $articles=DB::table('articles')
            ->select('articles.*')
            ->where('id','!=',$oldart->id)
            ->OrderBy('Updated_at','desc')->get();
        
        
        return view('stocks.edit',[
            'stock'=>$stock,
            'oldart'=>$oldart,
            'articles'=>$articles,
            ]);
        
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
        $stk=Stock::findOrFail($id);

        $stk->Qte_stock=$request->get('Qte');
        $stk->save();
        DB::table('articleastocks')
            ->where('stock_id','=',$id)
            ->update(['article_id' => $request->get('article')]);

        $request->session()->flash('status','Votre stock à été bien modifier!');
        
        return redirect()->route('stocks.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Articleastock::where('stock_id',$id)->delete();
        Stock::destroy($id);

        $request->session()->flash('status','Le stock à été supprimé!'); 

        return  redirect()->route('stocks.index');
    }
}
