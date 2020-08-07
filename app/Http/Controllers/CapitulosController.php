<?php

namespace App\Http\Controllers;

use App\Capitulos;
use App\Imagens;
use App\Mangas;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Array_;

class CapitulosController extends Controller
{
    
    public function painel()
    {
        if(Auth::user()->acesso == 1) {
            
            $mangas = Mangas::all();
            
            return view('painel',['mangas'=>$mangas]);

        } else {
            return view('inicio');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required'
        ];

        $capitulo = new Capitulos;
        $capitulo->nome = $request->nome;
        $capitulo->idManga = $request->manga;
        $capitulo->save();
        $nome = Mangas::find($request->manga);
        $nome = str_replace(' ', '', $nome->nome);
        if($capitulo->save()) {
            
            if(Storage::disk('public')->makeDirectory('mangas/'.$nome)){}
            
            if(Storage::disk('public')
            ->makeDirectory('mangas/'.$nome.'/'.$request->nome)){}
            
            $validador = Validator::make($request->all(),$this->upload($request->imagem,$request->nome,$nome,$request->manga,$capitulo->id,$regras)) ;

            if($validador->fails()){
    
                return back()->withErrors($validador);
    
            }
            
            return view('painel',['numero'=>$request->file('imagem')]);

        } else {

            return back()->with('erro','Algo errado tomou lugar do processo.');

        }
    }

    /**
     * Função para realizar o carregamento de multiplas imagens
     * @param String $nome
     */
    public function upload(Array $arquivos,String $capituloNome, String $mangaNome,Int $mangaID, Int $capituloID, Array $regras){
        $numero = 1;
        foreach($arquivos as $imagem){
            $regras['imagem.' . $imagem] = 'image|mimes:jpeg,bmp,png|size:2000';

            $imagens = new Imagens;        
            $imagem->storeAs('mangas/'.$mangaNome.'/'.$capituloNome, "/imagem{$numero}.jpg", 'public');
            $imagens->local = 'mangas/'.$mangaNome.'/'.$capituloNome."/imagem{$numero}.jpg";
            $imagens->idManga = $mangaID;
            $imagens->idCapitulo = $capituloID;
            $imagens->save();
            $numero++;
            

            return $regras;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Capitulos  $capitulos
     * @return \Illuminate\Http\Response
     */
    public function show(Capitulos $capitulos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Capitulos  $capitulos
     * @return \Illuminate\Http\Response
     */
    public function edit(Capitulos $capitulos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capitulos  $capitulos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capitulos $capitulos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capitulos  $capitulos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capitulos $capitulos)
    {
        //
    }
}
