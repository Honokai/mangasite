<?php

namespace App\Http\Controllers;

use App\Mangas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class MangasController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nome = str_replace(' ', '', $request->nome);
        
        Storage::disk('public')->makeDirectory('mangas/'.$nome);
        $request->imagem->storeAs('mangas/'.$nome, 'capa.jpg', 'public');
        //Storage::disk('public')->put('mangas/'.$nome."/capa.jpg", $request->imagem);

        $imagem = 'mangas/'.$nome."/capa.jpg";

        $regras = array(
            'nome' => 'required',
            'descricao' => 'required'
        );

        $validador = Validator::make($request->all(), $regras);
        
        if($validador->fails()) {
            
            return back()->withInput()->withErrors($validador);

        } else {
            
            $manga = new Mangas;

            $manga->nome = $request->nome;
            $manga->descricao = $request->descricao;
            $manga->imagem = $imagem;
            
            if($manga->save()){
                return back()->with('status',"Manga adicionado com sucesso.");
            } else {
                return back()->with('status',"Algo não funcionou como o esperado.");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mangas  $mangas
     * @return \Illuminate\Http\Response
     */
    public function show(Mangas $mangas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mangas  $mangas
     * @return \Illuminate\Http\Response
     */
    public function edit(Mangas $mangas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mangas  $mangas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mangas $mangas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mangas  $mangas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mangas $mangas)
    {
        //
    }
}