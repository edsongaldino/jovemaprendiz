<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use App\Estado;
use App\Cidade;
use App\EmpresaContato;
use App\Endereco;
use App\EmpresaUser;
use App\User;
use App\Helpers\Helper;
use App\IeEmpresa;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('sistema.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();
        return view('sistema.empresas.adicionar', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if((New Empresa())->verificaDuplicidade('cnpj', $request->cnpj)){
            return redirect()->back()->with('warning', 'Este CNPJ já consta em nosso banco de dados! Verifique.'); 
        }

        $endereco = (new EnderecoController())->salvarEndereco($request);

        $empresa = new Empresa();
        $empresa->endereco_id = $endereco->id;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->tipo_cadastro = $request->tipo_cadastro;

        if($request->tipo_cadastro == 'CEI'){
        $empresa->cei = Helper::limpa_campo($request->cei);
        }else{
        $empresa->cnpj = Helper::limpa_campo($request->cnpj);
        }

        if($request->tipo_empresa == 'Filial'){
            $empresa->cnpj_matriz = Helper::limpa_campo($request->cnpj_matriz);
        }
        
        $empresa->atividade_principal = $request->atividade_principal;
        $empresa->conta_contabil = Helper::limpa_campo($request->conta_contabil);
        
        $empresa->inscricao_estadual = $request->inscricao_estadual;
        $empresa->razao_social = $request->razao_social;
        $empresa->nome_fantasia = $request->nome_fantasia;
        $empresa->telefone = Helper::limpa_campo($request->telefone);
        $empresa->nome_responsavel = $request->nome_responsavel;
        $empresa->telefone_responsavel = Helper::limpa_campo($request->telefone_responsavel);
        $empresa->email_responsavel = $request->email_responsavel;
        $empresa->cpf_responsavel = Helper::limpa_campo($request->cpf_responsavel);
        $empresa->rg_responsavel = $request->rg_responsavel;
        $empresa->emissor_rg_responsavel = $request->emissor_rg_responsavel;

        $empresa->save();

        if($request->varias_inscricoes && $request->inscEstadual) {
            (new IeEmpresa())->salvarInscricoes($request, $empresa);
        }        

        if ($request->contato_setor) {
    		(new EmpresaContato())->salvarContatos($request, $empresa);
    	}

        return redirect()->route('sistema.empresas')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::find($id);
        $estados = Estado::all();
        $endereco = Endereco::find($empresa->endereco_id);
        $cidades = Cidade::where('estado_id','=', $empresa->endereco->cidade->estado_id)->orderBy('nome_cidade','asc')->get();
        return view('sistema.empresas.editar', compact('estados', 'empresa', 'endereco', 'cidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {

        $empresa = Empresa::findOrFail($request->id);

        if($request->cnpj <> $empresa->cnpj){
            if((New Empresa())->verificaDuplicidade('cnpj', $request->cnpj)){
                return redirect()->back()->with('warning', 'Este CNPJ já consta em nosso banco de dados! Verifique.'); 
            }
        }

        $empresa->tipo_empresa = $request->tipo_empresa;

        if($request->tipo_cadastro == 'CEI'){
            $empresa->cei = Helper::limpa_campo($request->cei);
        }else{
            $empresa->cnpj = Helper::limpa_campo($request->cnpj);
        }

        if($request->tipo_empresa == 'Filial'){
            $empresa->cnpj_matriz = Helper::limpa_campo($request->cnpj_matriz);
        }

        $empresa->conta_contabil = Helper::limpa_campo($request->conta_contabil);
        $empresa->atividade_principal = $request->atividade_principal;
        $empresa->inscricao_estadual = $request->inscricao_estadual;
        $empresa->razao_social = $request->razao_social;
        $empresa->nome_fantasia = $request->nome_fantasia;
        $empresa->telefone = Helper::limpa_campo($request->telefone);
        $empresa->nome_responsavel = $request->nome_responsavel;
        $empresa->telefone_responsavel = Helper::limpa_campo($request->telefone_responsavel);
        $empresa->email_responsavel = $request->email_responsavel;
        $empresa->cpf_responsavel = Helper::limpa_campo($request->cpf_responsavel);
        $empresa->rg_responsavel = $request->rg_responsavel;
        $empresa->emissor_rg_responsavel = $request->emissor_rg_responsavel;
        $empresa->save();

        (new EnderecoController())->updateEndereco($request, $request->endereco_id);

        if ($request->inscEstadual) {
    		(new IeEmpresa())->salvarInscricoes($request, $empresa);
    	}

        if ($request->contato_setor) {
    		(new EmpresaContato())->salvarContatos($request, $empresa);
    	}


        return redirect()->route('sistema.empresas')->with('success', 'Dados Atualizados!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $empresa = Empresa::find($request->id);

        DB::beginTransaction();
        $endereco = Endereco::findOrFail($empresa->endereco_id);

        if($endereco->delete()):
            if($empresa->delete()):
                DB::commit();
                return true;
            endif;
        else:
            DB::rollBack();
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;
    }

    public function consultaCNPJ($cnpj){
        
        //Garantir que seja lido sem problemas
        header("Content-Type: text/plain");

        //Criando Comunicação cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/".$cnpj);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Descomente esta linha apenas se você não usar HTTPS, ou se estiver testando localmente
        $retorno = curl_exec($ch);
        curl_close($ch);

        $retorno = json_decode($retorno); //Ajuda a ser lido mais rapidamente
        return json_encode($retorno, JSON_PRETTY_PRINT);

    }

    public function equipe($id)
    {
        $empresa = Empresa::find($id);
        $equipe = User::select('users.nome', 'users.email', 'empresa_user.id', 'perfis.nome as nome_perfil')
            ->join('empresa_user', 'users.id', '=', 'empresa_user.user_id')
            ->join('perfis', 'users.perfil_id', '=', 'perfis.id')
            ->where('empresa_user.empresa_id', '=', $id)
            ->get();
        
        $empresa_users = EmpresaUser::where('empresa_id', '=', $id)->select('user_id')->get()->toArray();
        $usuarios = User::whereNotIn('id', $empresa_users)->get();

        return view('sistema.empresas.equipe', compact('empresa', 'usuarios', 'equipe'));
    }

    public function EquipeAdd(Request $request)
    {

        $EmpresaUser = new EmpresaUser();
        $EmpresaUser->user_id = $request->user_id;
        $EmpresaUser->empresa_id = $request->empresa_id;

        if($EmpresaUser->save()):
            return redirect('sistema/empresa/'.$request->empresa_id.'/equipe')->with('success', 'Usuário incluído à equipe!');
        else:
            return redirect('sistema/empresa/'.$request->empresa_id.'/equipe')->with('warning', 'Erro ao incluir membro!');
        endif;

    }

    public function EquipeExcluir(Request $request)
    {

        $empresa_user = EmpresaUser::find($request->id);

        if($empresa_user->delete()):
            return true;
        else:
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;

    }

}
