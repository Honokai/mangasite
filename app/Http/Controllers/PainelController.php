<?php

namespace App\Http\Controllers;

use App\Mangas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    public function painel()
    {
        if(Auth::user()->acesso == 1) {
            
            return view('painel');

        } else {
            return view('inicio');
        }
    }

}
