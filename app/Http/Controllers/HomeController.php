<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dash()
    {
        return view('dash');
    }
    public function search(Request $request){
        $searchData=$request->searchdata;

        if($searchData!=""){
            $datas=DB::table('articles')
                ->where('Nom_artc','like',$searchData.'%')
                ->paginate(10);
            return view('search',['datas'=>$datas,'datasearch'=>$searchData]);
        }
        else{
            $datas="";
            return view('search',['datas'=>$datas,'datasearch'=>$searchData]);
        }
        
    }

}