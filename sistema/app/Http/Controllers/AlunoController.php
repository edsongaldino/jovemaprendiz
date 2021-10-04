<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Conjuge;
use App\Estado;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Polo;
use App\Endereco;
use App\Cidade;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::all();
        return view('sistema.alunos.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();
        $polos = Polo::all();
        return view('sistema.alunos.adicionar', compact('estados', 'polos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if((New Aluno())->verificaDuplicidade('cpf', $request->cpf)){
            return redirect()->back()->with('warning', 'Este CPF já consta em nosso banco de dados! Verifique.'); 
        }

        if((New UserController())->verificaDuplicidade('email', $request->email)){
            return redirect()->back()->with('warning', 'Este e-mail ja está cadastrado! Verifique.'); 
        }

        $endereco = (new EnderecoController())->salvarEndereco($request);      
        $user = (new UserController())->salvarUsuario($request);

        $aluno = new Aluno();
        $aluno->endereco_id = $endereco->id;
        $aluno->polo_id = $request->polo_id;
        $aluno->user_id = $user->id;
        $aluno->nome = $request->nome;
        $aluno->sexo = $request->sexo;
        $aluno->cpf = Helper::limpa_campo($request->cpf);
        $aluno->rg = Helper::limpa_campo($request->rg);
        $aluno->orgao_expedidor = $request->orgao_expedidor;
        $aluno->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $aluno->telefone = Helper::limpa_campo($request->telefone);
        $aluno->whatsapp = Helper::limpa_campo($request->whatsapp);
        $aluno->estado_civil = $request->estado_civil;
        $aluno->situacao = $request->situacao;
        $aluno->escolaridade = $request->escolaridade;
        $aluno->turno = $request->turno;
        $aluno->contra_turno = $request->contra_turno;
        $aluno->situacao = 'Ativo';
        $aluno->save();     

        if($request->estado_civil == 'Casado'){
            (new ConjugeController())->store($request, $aluno);
        }

        return redirect()->route('sistema.alunos')->with('success', 'Dados Cadastrados!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $alunos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::find($id);
        $estados = Estado::all();
        $polos = Polo::all();
        $endereco = Endereco::find($aluno->endereco_id);
        $cidades = Cidade::where('estado_id','=', $aluno->endereco->cidade->estado_id)->orderBy('nome_cidade','asc')->get();
        return view('sistema.alunos.editar', compact('estados', 'aluno', 'endereco', 'cidades', 'polos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $aluno = Aluno::findOrFail($request->id);
        $aluno->polo_id = $request->polo_id;
        $aluno->nome = $request->nome;
        $aluno->sexo = $request->sexo;
        $aluno->cpf = Helper::limpa_campo($request->cpf);
        $aluno->rg = Helper::limpa_campo($request->rg);
        $aluno->orgao_expedidor = $request->orgao_expedidor;
        $aluno->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $aluno->telefone = Helper::limpa_campo($request->telefone);
        $aluno->whatsapp = Helper::limpa_campo($request->whatsapp);
        $aluno->estado_civil = $request->estado_civil;
        $aluno->situacao = $request->situacao;
        $aluno->escolaridade = $request->escolaridade;
        $aluno->turno = $request->turno;
        $aluno->contra_turno = $request->contra_turno;
        $aluno->situacao = 'Ativo';
        $aluno->save(); 

        (new EnderecoController())->updateEndereco($request, $request->endereco_id);
        (new UserController())->updateUsuario($request, $request->user_id);

        if($request->estado_civil == 'Casado' && $request->conjuge_id <> ''){
            (new ConjugeController())->update($request);
        }elseif($request->estado_civil == 'Casado' && $request->conjuge_id == ''){
            (new ConjugeController())->store($request, $aluno);
        }

        return redirect()->route('sistema.alunos')->with('success', 'Dados Atualizados!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $aluno = Aluno::find($request->id);

        DB::beginTransaction();
        $endereco = Endereco::findOrFail($aluno->endereco_id);
        $user = Endereco::findOrFail($aluno->user_id);

        if($endereco->delete() && $user->delete()):
            $aluno->delete();
            DB::commit();
            return true;
        else:
            DB::rollBack();
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;
    }

}
