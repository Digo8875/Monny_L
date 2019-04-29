<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Registro_financeiro;
use App\Models\Tipo_dinheiro;
use App\Models\Responsavel;
use App\Models\Sub_categoria;

class Registro_financeiroController extends Controller
{
    public function index()
    {
        $lista_registros_financeiros = Registro_financeiro::get_registro_financeiro(0, Auth::user()->id);
        
        return view('registro_financeiro.index',['lista_registros_financeiros' => $lista_registros_financeiros]);
    }
  
    public function create()
    {
    	$registro_financeiro = new Registro_financeiro;
        $lista_tipo_dinheiros = Tipo_dinheiro::where('ativo','=','1')->pluck('nome', 'id')->all();
        $lista_responsaveis = Responsavel::where('ativo','=','1')->pluck('nome', 'id')->all();
        $lista_sub_categorias = Sub_categoria::get_sub_categoria(0)->where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('registro_financeiro.create_edit',['obj' => $registro_financeiro, 'lista_tipo_dinheiros' => $lista_tipo_dinheiros, 'lista_responsaveis' => $lista_responsaveis, 'lista_sub_categorias' => $lista_sub_categorias]);
    }
  
    public function store(Request $request)
    {
        $this->valida($request);

        $registro_financeiro = new Registro_financeiro;
        $registro_financeiro->nome = $request['nome'];
        $registro_financeiro->descricao = $request['descricao'];
        $registro_financeiro->valor = $request['valor'];
        $registro_financeiro->tipo = $request['tipo'];
        $registro_financeiro->doacao = $request['doacao'];
        if($request['ativo'] == true)
        	$registro_financeiro->ativo = 1;
        else
        	$registro_financeiro->ativo = 0;

        $registro_financeiro->save();

        return redirect()->route('registro_financeiro.index');
    }
  
    public function show($id)
    {
        $registro_financeiro = Registro_financeiro::get_registro_financeiro($id, Auth::user()->id);
        return view('registro_financeiro.detalhes',['obj' => $registro_financeiro]);
    }
  
    public function edit($id)
    {
        $registro_financeiro = Registro_financeiro::get_registro_financeiro($id, Auth::user()->id);
        $lista_tipo_dinheiros = Tipo_dinheiro::where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('registro_financeiro.create_edit',['obj' => $registro_financeiro, 'lista_tipo_dinheiros' => $lista_tipo_dinheiros]);
    }
  
    public function update(Request $request, $id)
    {
        $this->valida($request);

        $registro_financeiro = Registro_financeiro::findOrFail($id);
        $registro_financeiro->nome = $request['nome'];
        $registro_financeiro->descricao = $request['descricao'];
        $registro_financeiro->usuario_id = $request['usuario_id'];
        if($request['carteira_mestre_id'] != 0)
            $registro_financeiro->carteira_mestre_id = $request['carteira_mestre_id'];
        else
            $registro_financeiro->carteira_mestre_id = NULL;
        if($request['ativo'] == true)
            $registro_financeiro->ativo = 1;
        else
            $registro_financeiro->ativo = 0;

        $registro_financeiro->save();

        return redirect()->route('registro_financeiro.index');
    }
  
    public function destroy($id)
    {
        $registro_financeiro = Registro_financeiro::findOrFail($id);
        $registro_financeiro->delete();

        return redirect()->route('registro_financeiro.index');
    }

    public function desativar($id)
    {
        $registro_financeiro = Registro_financeiro::findOrFail($id);
        $registro_financeiro->ativo = 0;

        $registro_financeiro->save();
        return redirect()->route('registro_financeiro.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|regex:/^[\pL\s\-]+$/u',
            'descricao' => 'required',
            'tipo_registro_financeiro' => 'required',
            'tipo_dinheiro_id' => 'required',
            'valor' => 'required',
            'sub_categoria_id' => 'required',
        ],[
            'nome.required' => 'Preencha o nome do registro_financeiro.',
            'nome.regex' => 'O nome do registro_financeiro deve conter apenas letras.',
            'descricao.required' => 'Preencha a descrição do registro_financeiro.',
            'tipo_registro_financeiro.required' => 'Selecione o tipo do registro_financeiro.',
            'tipo_dinheiro_id.required' => 'Selecione a moeda do registro_financeiro.',
            'valor.required' => 'Preencha o valor do registro_financeiro.',
            'sub_categoria_id.required' => 'Selecione a subcategoria do registro_financeiro.',
        ]);
    }
}