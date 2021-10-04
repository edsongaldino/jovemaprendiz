<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'AppController@index')->name('sistema')->middleware('auth');

Route::get('/login', 'AppController@login')->name('login');
Route::get('/sistema', 'AppController@index')->name('sistema')->middleware('auth');
Route::get('/sistema/alunos', 'AlunoController@index')->name('alunos')->middleware('auth');
Route::get('/sistema/configuracoes', 'AppController@configuracoes')->name('configuracoes')->middleware('auth');
Route::get('/sistema/polos', 'AppController@polos')->name('polos')->middleware('auth');
Route::get('/sistema/contratos', 'AppController@contratos')->name('contratos')->middleware('auth');
Route::get('/sistema/financeiro', 'AppController@financeiro')->name('financeiro')->middleware('auth');
Route::get('/sistema/estoque', 'AppController@estoque')->name('estoque')->middleware('auth');
Route::get('/sistema/vagas', 'AppController@vagas')->name('vagas')->middleware('auth');
Route::get('/sistema/eventos', 'AppController@eventos')->name('eventos')->middleware('auth');
Route::get('/sistema/relatorios', 'AppController@relatorios')->name('relatorios')->middleware('auth');

//LOGIN ROTAS
Route::post('/login/do', 'AuthController@Login')->name('login.do');
Route::get('logout', 'AuthController@Logout')->name('logout')->middleware('auth');

//User Rotas
Route::get('sistema/usuarios', 'UserController@index')->name('sistema.usuarios')->middleware('auth');
Route::get('sistema/usuarios/adicionar', 'UserController@create')->name('sistema.usuarios.adicionar')->middleware('auth');
Route::post('sistema/usuario/salvar', 'UserController@store')->name('sistema.usuario.salvar')->middleware('auth');
Route::get('sistema/usuario/{id}/editar', 'UserController@edit')->name('sistema.usuario.editar')->middleware('auth');
Route::post('sistema/usuario/update', 'UserController@update')->name('sistema.usuario.update')->middleware('auth');
Route::post('sistema/usuario/excluir', 'UserController@destroy')->name('sistema.usuario.excluir')->middleware('auth');

//Perfis rotas
Route::get('sistema/perfis', 'PerfilController@index')->name('sistema.perfis')->middleware('auth');
Route::get('sistema/perfil/adicionar', 'PerfilController@create')->name('sistema.perfil.adicionar')->middleware('auth');
Route::post('sistema/perfil/salvar', 'PerfilController@store')->name('sistema.perfil.salvar')->middleware('auth');
Route::get('sistema/perfil/{id}/editar', 'PerfilController@edit')->name('sistema.perfil.editar')->middleware('auth');
Route::post('sistema/perfil/update', 'PerfilController@update')->name('sistema.perfil.update')->middleware('auth');
Route::post('sistema/perfil/excluir', 'PerfilController@destroy')->name('sistema.perfil.excluir')->middleware('auth');

//Pólos rotas
Route::get('sistema/polos', 'PoloController@index')->name('sistema.polos')->middleware('auth');
Route::get('sistema/polo/adicionar', 'PoloController@create')->name('sistema.polo.adicionar')->middleware('auth');
Route::post('sistema/polo/salvar', 'PoloController@store')->name('sistema.polo.salvar')->middleware('auth');
Route::get('sistema/polo/{id}/editar', 'PoloController@edit')->name('sistema.polo.editar')->middleware('auth');
Route::post('sistema/polo/update', 'PoloController@update')->name('sistema.polo.update')->middleware('auth');
Route::post('sistema/polo/excluir', 'PoloController@destroy')->name('sistema.polo.excluir')->middleware('auth');

Route::get('sistema/polo/{id}/equipe', 'PoloController@equipe')->name('sistema.polo.equipe')->middleware('auth');
Route::post('sistema/polo/equipe/adicionar', 'PoloController@EquipeAdd')->name('sistema.polo.equipe.adicionar')->middleware('auth');
Route::post('sistema/polo/equipe/excluir', 'PoloController@EquipeExcluir')->name('sistema.polo.equipe.excluir')->middleware('auth');

//Regiões rotas
Route::get('sistema/regioes', 'RegiaoController@index')->name('sistema.regioes')->middleware('auth');
Route::get('sistema/regiao/adicionar', 'RegiaoController@create')->name('sistema.regiao.adicionar')->middleware('auth');
Route::post('sistema/regiao/salvar', 'RegiaoController@store')->name('sistema.regiao.salvar')->middleware('auth');
Route::get('sistema/regiao/{id}/editar', 'RegiaoController@edit')->name('sistema.regiao.editar')->middleware('auth');
Route::post('sistema/regiao/update', 'RegiaoController@update')->name('sistema.regiao.update')->middleware('auth');
Route::post('sistema/regiao/excluir', 'RegiaoController@destroy')->name('sistema.regiao.excluir')->middleware('auth');
Route::post('sistema/regiao/responsavel/adicionar', 'RegiaoController@AdicionarResponsavel')->name('sistema.regiao.responsavel.adicionar')->middleware('auth');

//Pólos rotas
Route::get('sistema/empresas', 'EmpresaController@index')->name('sistema.empresas')->middleware('auth');
Route::get('sistema/empresa/adicionar', 'EmpresaController@create')->name('sistema.empresa.adicionar')->middleware('auth');
Route::post('sistema/empresa/salvar', 'EmpresaController@store')->name('sistema.empresa.salvar')->middleware('auth');
Route::get('sistema/empresa/{id}/editar', 'EmpresaController@edit')->name('sistema.empresa.editar')->middleware('auth');
Route::post('sistema/empresa/update', 'EmpresaController@update')->name('sistema.empresa.update')->middleware('auth');
Route::post('sistema/empresa/excluir', 'EmpresaController@destroy')->name('sistema.empresa.excluir')->middleware('auth');

Route::get('sistema/empresa/consulta-cnpj/{cnpj}', 'EmpresaController@consultaCNPJ')->name('sistema.empresa.consultaCNPJ')->middleware('auth');

Route::get('sistema/empresa/{id}/equipe', 'EmpresaController@equipe')->name('sistema.empresa.equipe')->middleware('auth');
Route::post('sistema/empresa/equipe/adicionar', 'EmpresaController@EquipeAdd')->name('sistema.empresa.equipe.adicionar')->middleware('auth');
Route::post('sistema/empresa/equipe/excluir', 'EmpresaController@EquipeExcluir')->name('sistema.empresa.equipe.excluir')->middleware('auth');


//Rotas Alunos
Route::get('sistema/alunos', 'AlunoController@index')->name('sistema.alunos')->middleware('auth');
Route::get('sistema/aluno/adicionar', 'AlunoController@create')->name('sistema.aluno.adicionar')->middleware('auth');
Route::post('sistema/aluno/salvar', 'AlunoController@store')->name('sistema.aluno.salvar')->middleware('auth');
Route::get('sistema/aluno/{id}/editar', 'AlunoController@edit')->name('sistema.aluno.editar')->middleware('auth');
Route::post('sistema/aluno/update', 'AlunoController@update')->name('sistema.aluno.update')->middleware('auth');
Route::post('sistema/aluno/excluir', 'AlunoController@destroy')->name('sistema.aluno.excluir')->middleware('auth');


//Rotas Alunos
Route::get('sistema/cursos', 'CursoController@index')->name('sistema.cursos')->middleware('auth');
Route::get('sistema/curso/adicionar', 'CursoController@create')->name('sistema.curso.adicionar')->middleware('auth');
Route::post('sistema/curso/salvar', 'CursoController@store')->name('sistema.curso.salvar')->middleware('auth');
Route::get('sistema/curso/{id}/editar', 'CursoController@edit')->name('sistema.curso.editar')->middleware('auth');
Route::post('sistema/curso/update', 'CursoController@update')->name('sistema.curso.update')->middleware('auth');
Route::post('sistema/curso/excluir', 'CursoController@destroy')->name('sistema.curso.excluir')->middleware('auth');

//Rotas Alunos
Route::get('sistema/contratos', 'ContratoController@index')->name('sistema.contratos')->middleware('auth');
Route::get('sistema/contrato/adicionar', 'ContratoController@create')->name('sistema.contrato.adicionar')->middleware('auth');
Route::post('sistema/contrato/salvar', 'ContratoController@store')->name('sistema.contrato.salvar')->middleware('auth');
Route::get('sistema/contrato/{id}/editar', 'ContratoController@edit')->name('sistema.contrato.editar')->middleware('auth');
Route::post('sistema/contrato/update', 'ContratoController@update')->name('sistema.contrato.update')->middleware('auth');
Route::post('sistema/contrato/excluir', 'ContratoController@destroy')->name('sistema.contrato.excluir')->middleware('auth');

//Rotas Alunos
Route::get('sistema/tabelas', 'TabelaController@index')->name('sistema.tabelas')->middleware('auth');
Route::get('sistema/tabela/adicionar', 'TabelaController@create')->name('sistema.tabela.adicionar')->middleware('auth');
Route::post('sistema/tabela/salvar', 'TabelaController@store')->name('sistema.tabela.salvar')->middleware('auth');
Route::get('sistema/tabela/{id}/editar', 'TabelaController@edit')->name('sistema.tabela.editar')->middleware('auth');
Route::post('sistema/tabela/update', 'TabelaController@update')->name('sistema.tabela.update')->middleware('auth');
Route::post('sistema/tabela/excluir', 'TabelaController@destroy')->name('sistema.tabela.excluir')->middleware('auth');

//Enderecos
Route::get('/sistema/endereco/get-cidades/{id}', 'EnderecoController@getCidades');