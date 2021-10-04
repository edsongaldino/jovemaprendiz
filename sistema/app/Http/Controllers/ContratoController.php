<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Contrato;
use App\Empresa;
use App\Polo;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Tabela;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Contrato::all();
        return view('sistema.contratos.index', compact('contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $polos = Polo::all();
        $empresas = Empresa::all();
        $alunos = Aluno::all();
        $tabelas = Tabela::all();
        return view('sistema.contratos.adicionar', compact('polos', 'empresas', 'alunos', 'tabelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contrato = new Contrato();
        $contrato->polo_id = $request->polo_id;
        $contrato->empresa_id = $request->empresa_id;
        $contrato->aluno_id = $request->aluno_id;
        $contrato->tabela_id = $request->tabela_id;
        $contrato->data_inicial = Helper::data_mysql($request->data_inicial);
        $contrato->data_final = Helper::data_mysql($request->data_final);
        $contrato->situacao = $request->situacao;
        $contrato->save(); 

        return redirect()->route('sistema.contratos')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrato = Contrato::find($id);
        $polos = Polo::all();
        $empresas = Empresa::all();
        $alunos = Aluno::all();
        $tabelas = Tabela::all();
        return view('sistema.contratos.editar', compact('contrato', 'polos', 'empresas', 'alunos', 'tabelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $contrato = Contrato::findOrFail($request->id);
        $contrato->polo_id = $request->polo_id;
        $contrato->empresa_id = $request->empresa_id;
        $contrato->aluno_id = $request->aluno_id;
        $contrato->tabela_id = $request->tabela_id;
        $contrato->data_inicial = Helper::data_mysql($request->data_inicial);
        $contrato->data_final = Helper::data_mysql($request->data_final);
        $contrato->situacao = $request->situacao;
        $contrato->save(); 

        return redirect()->route('sistema.contratos')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contrato = Contrato::find($request->id);

        if($contrato->delete()):
            return true;
        else:
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;
    }
}
