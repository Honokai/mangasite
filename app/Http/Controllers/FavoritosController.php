<?php

namespace App\Http\Controllers;

use App\Favoritos;
use App\Mangas;
use Illuminate\Http\Request;

class FavoritosController extends Controller
{
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
        $favorito = new Favoritos;
        $favorito->MangaId = $request->manga;
        $favorito->UsuarioID = $request->usuario;
        
        if($favorito->save()){
            return back()->with('mensagem', "Adicionado aos favoritos");    
        } else {
            return back()->withErrors(['Erro','Não foi possível adicionar aos favoritos']);
        }
        
        
        //return back()->with('mensagem','Incluído a sua lista de favoritos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function show(Int $usuarioID)
    {
        $favoritos = Favoritos::where('UsuarioID','=',$usuarioID)->get();
        $nomes = array();
        
        if(is_null($favoritos)){
            return back();
        } else {
            foreach($favoritos as $index){
                $manga = Mangas::where('id','=',$index->MangaID)->first();
                array_push($nomes,$manga->nome);
            }
            return view('favoritos', ['favoritos' => $nomes]);
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function edit(Favoritos $favoritos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favoritos $favoritos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favoritos $favoritos)
    {
        //
    }
}
