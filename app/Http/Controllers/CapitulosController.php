<?php

namespace App\Http\Controllers;

use App\Capitulos;
use App\Imagens;
use App\Mangas;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Array_;

class CapitulosController extends Controller
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
    {   $mangas = Mangas::all();
        return view('formularios.adicionar_capitulo',['mangas'=> $mangas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        //$validar = $request->validate(['nome'=>'required','imagem'=>'image|mimes:png,jpeg']);

        /*verifica se tem imagem caso contrario volta a pagina anterior com mensagem de erro*/
        if($request->hasFile('imagem')){
            /*foreach($request->imagem as $imagem){

                array_push($regras['imagem.'.$imagem] = 'required|image|mimes:jpeg,png');

            }*/
            $regras = [
                'nome' => 'required',
                'imagem.*' => 'required|image|mimes:jpeg,png'
            ];
        } else {

            return back()->withInput()->withErrors(['Falha'=>'Imagens do capítulo não anexadas.']);

        }
        
        $validador = Validator::make($request->all(), $regras);

        if($validador->fails()){

            return back()->withInput()->withErrors($validador);

        }

        $capitulo = new Capitulos;
        $capitulo->nome = $request->nome;
        $capitulo->idManga = $request->manga;
        $capitulo->save();
        $nome = Mangas::find($request->manga);
        $nome = str_replace(' ', '', $nome->nome);

        if($capitulo->save()) {
            
            if(Storage::disk('public')->makeDirectory('mangas/'.$nome)) {}
            
            if(Storage::disk('public')->
            makeDirectory('mangas/'.$nome.'/'.$request->nome)) {}
            
            if($request->hasFile('imagem')) {
                if($this->upload($request->imagem,$request->nome,$nome,$request->manga,$capitulo->id)){
                    return back();    
                } else {
                    DB::delete('delete capitulos where id = ?', $capitulo->id);
                    return back()->withErrors(['Falha', 'Não foi possível adicionar o capítulo, verifique os itens enviados e tente novamente.']);
                }
            } else {
                return back();
            }
            
            

        } else {

            return back()->withInput()->with('erro','Algo deu errado');

        }
    }

    /**
     * Função para realizar o carregamento de multiplas imagens
     * @param String $nome
     */
    public function upload(Array $arquivos,String $capituloNome, String $mangaNome,Int $mangaID, Int $capituloID){
        $numero = 1;
        foreach($arquivos as $imagem){

            $imagens = new Imagens;        
            
            $imagem->storeAs('mangas/'.$mangaNome.'/'.$capituloNome, 
            "/imagem{$numero}.{$imagem->getClientOriginalExtension()}",
             'public');

            $imagens->local = 'mangas/'.$mangaNome.'/'.$capituloNome."/imagem{$numero}.{$imagem->getClientOriginalExtension()}";
            $imagens->idManga = $mangaID;
            $imagens->idCapitulo = $capituloID;
            try {
                $imagens->save();
            } catch (\Throwable $th) {
                return False;
            }
            $numero++;
            
        }

        return True;
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

    /**
     * Realiza a busca das imagens atreladas a determinado capítulo
     * @param String $manga
     * @param String $capitulo
     * @return view com coleção de imagens do capitulo e capitulos do manga em questão
     */
    public function imagens(String $manga, String $capitulo)
    {
        $Manga = Mangas::where('nome','=',$manga)->first(); 
        
        $Capitulos = Capitulos::where('idManga','=',$Manga->id)->get();
        
        $selecionado = Capitulos::where('nome','=',$capitulo)
        ->where('idManga','=',$Manga->id)->first();
        
        $imagens = Imagens::where('idManga','=', $Manga->id)
        ->where('idCapitulo','=', $selecionado->id)->get();
        
        return view('ler',['imagens'=>$imagens,'Capitulos'=>$Capitulos,'lendo' => $selecionado->id]);
    }
}
