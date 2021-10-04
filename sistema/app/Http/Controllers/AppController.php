<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;

class AppController extends Controller
{

    
    public function login(){
        return view('sistema.login');
    }

    public function index(){
        return view('sistema.home');
    }

    public function cursos(){
        return view('sistema.cursos.index'); 
    }

    public function configuracoes(){
        return view('sistema.configuracoes.index'); 
    }

    public function polos(){
        return view('sistema.polos.index'); 
    }

    public function empresas(){
        return view('sistema.empresas.index'); 
    }

    public function alunos(){
        return view('sistema.alunos.index'); 
    }

    public function contratos(){
        return view('sistema.contratos.index'); 
    }

    public function financeiro(){
        return view('sistema.financeiro.index'); 
    }

    public function estoque(){
        return view('sistema.estoque.index'); 
    }

    public function vagas(){
        return view('sistema.vagas.index'); 
    }

    public function eventos(){
        return view('sistema.eventos.index'); 
    }

    public function relatorios(){
        return view('sistema.relatorios.index'); 
    }
}
