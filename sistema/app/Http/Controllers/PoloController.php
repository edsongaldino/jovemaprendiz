<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Polo;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Endereco;
use App\PoloUser;
use App\Regiao;
use App\User;
use Illuminate\Support\Facades\DB;

class PoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polos = Polo::all();
        $regioes = Regiao::all();
        return view('sistema.polos.index', compact('polos', 'regioes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();
        $regioes = Regiao::all();
        $polos = Polo::all();
        return view('sistema.polos.adicionar', compact('estados', 'regioes', 'polos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $endereco = (new EnderecoController())->salvarEndereco($request);

        $polo = new Polo();
        $polo->endereco_id = $endereco->id;
        $polo->regiao_id = $request->regiao_id;
        $polo->tipo_polo = $request->tipo_polo;
        $polo->nome = $request->nome;
        $polo->telefone = Helper::limpa_campo($request->telefone);

        if(isset($request->polo_id)){
        $polo->polo_id = $request->polo_id;
        }

        $polo->save();

        return redirect()->route('sistema.polos')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Polo  $polo
     * @return \Illuminate\Http\Response
     */
    public function show(Polo $polo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Polo  $polo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $polo = Polo::find($id);
        $regioes = Regiao::all();
        $estados = Estado::all();
        $endereco = Endereco::find($polo->endereco_id);
        $polos = Polo::where('id', '<>', $id)->get();
        $cidades = Cidade::where('estado_id','=', $polo->endereco->cidade->estado_id)->orderBy('nome_cidade','asc')->get();
        return view('sistema.polos.editar', compact('estados', 'polo', 'endereco', 'cidades', 'regioes', 'polos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Polo  $polo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $polo = Polo::findOrFail($request->id);
        $polo->regiao_id = $request->regiao_id;
        $polo->tipo_polo = $request->tipo_polo;
        $polo->nome = $request->nome;
        $polo->telefone = Helper::limpa_campo($request->telefone);

        if(isset($request->polo_id)){
        $polo->polo_id = $request->polo_id;
        }

        $polo->save();

        (new EnderecoController())->updateEndereco($request, $request->endereco_id);

        return redirect()->route('sistema.polos')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Polo  $polo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $polo = Polo::find($request->id);

        DB::beginTransaction();
        $endereco = Endereco::findOrFail($polo->endereco_id);

        if($endereco->delete()):
            if($polo->delete()):
                DB::commit();
                return true;
            endif;
        else:
            DB::rollBack();
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;
    }

    public function equipe($id)
    {
        $polo = Polo::find($id);
        $equipe = User::select('users.nome', 'users.email', 'polo_user.id', 'perfis.nome as nome_perfil')
            ->join('polo_user', 'users.id', '=', 'polo_user.user_id')
            ->join('perfis', 'users.perfil_id', '=', 'perfis.id')
            ->where('polo_user.polo_id', '=', $id)
            ->get();
        
        $polo_users = PoloUser::where('polo_id', '=', $id)->select('user_id')->get()->toArray();
        $usuarios = User::whereNotIn('id', $polo_users)->get();

        return view('sistema.polos.equipe', compact('polo', 'usuarios', 'equipe'));
    }

    public function EquipeAdd(Request $request)
    {

        $PoloUser = new PoloUser();
        $PoloUser->user_id = $request->user_id;
        $PoloUser->polo_id = $request->polo_id;

        if($PoloUser->save()):
            return redirect('sistema/polo/'.$request->polo_id.'/equipe')->with('success', 'Usuário incluído à equipe!');
        else:
            return redirect('sistema/polo/'.$request->polo_id.'/equipe')->with('warning', 'Erro ao incluir membro!');
        endif;

    }

    public function EquipeExcluir(Request $request)
    {

        $Polo_user = PoloUser::find($request->id);

        if($Polo_user->delete()):
            return true;
        else:
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;

    }

}
