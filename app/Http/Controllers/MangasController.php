<?php

namespace App\Http\Controllers;

use App\Capitulos;
use App\Mangas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

use function GuzzleHttp\Promise\all;

class MangasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* */
        $paginacao = Mangas::orderByDesc('atualizado_em')->paginate(9); 
        $ultimos = Mangas::orderByDesc('atualizado_em')->take(3)->get();

        return view('inicio',['mangas' => $paginacao,'atualizados' => $ultimos, 'contador' => 0]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formularios.adicionar_manga');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nome = str_replace(' ', '', $request->nomemanga);
        
        $regras = array(
            'nomemanga' => 'required',
            'descricao' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png'
        );

        $validador = Validator::make($request->all(), $regras);
        
        if($validador->fails()) {
            
            return back()->withInput()->withErrors($validador);

        } else {
            Storage::disk('public')->makeDirectory('mangas/'.$nome);
            $request->imagem->storeAs('mangas/'.$nome, 'capa.jpg', 'public');
            //Storage::disk('public')->put('mangas/'.$nome."/capa.jpg", $request->imagem);

            $imagem = 'mangas/'.$nome."/capa.jpg";
            
            $manga = new Mangas;
            $manga->nome = $request->nomemanga;
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
     * @param  String $nome
     * @return \Illuminate\Http\Response
     */
    public function show($nome)
    {
        
        $manga = Mangas::where('nome', '=', $nome)->first();

        $capitulos = Capitulos::where('idManga', $manga->id)->get();

        return view('manga',['manga'=>$manga, 'capitulos'=>$capitulos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manga = Mangas::findOrFail($id);
        
        return view('edit.manga',['manga' => $manga]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mangas  $mangas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $manga = Mangas::findOrFail($request->id);
        $manga->nome = $request->nome;
        $manga->descricao = $request->descricao;
        $manga->save();
        return back()->with('mensagem', "Atualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mangas  $mangas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manga = Mangas::find($id);
        $manga->delete();
        return back();
    }

    public function formEdit()
    {
        return view('edit.manga',['mangas' => Mangas::orderBy('nome','asc')->get()]);
    }
/*
    public function formularioRemover()
    {
        return view('formularios.remover',['mangas' => Mangas::orderBy('nome','asc')->paginate(50)]);
    }
*/
}
