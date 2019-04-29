<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Divida;
use App\Models\Carteira;
use App\Models\Tipo_dinheiro;

class DividaController extends Controller
{
    public function index()
    {
        $lista_dividas = Divida::get_divida(0, Auth::user()->id);
        
        return view('divida.index',['lista_dividas' => $lista_dividas]);
    }
  
    public function create()
    {
    	$divida = new Divida;
        $lista_tipo_dinheiros = Tipo_dinheiro::where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('divida.create_edit',['obj' => $divida, 'lista_tipo_dinheiros' => $lista_tipo_dinheiros]);
    }
  
    public function store(Request $request)
    {
        $this->valida($request);

        $carteira = new Carteira;
        $carteira->nome = $request['nome'];
        $carteira->descricao = $request['descricao'];
        $carteira->usuario_id = $request['usuario_id'];
        $carteira->carteira_mestre_id = NULL;
        if($request['ativo'] == true)
            $carteira->ativo = 1;
        else
            $carteira->ativo = 0;

        $carteira->save();
        $carteira_id = $carteira->id;

        $divida= new Divida;
        $divida->carteira_id = $carteira_id;
        $divida->tipo_dinheiro_id = $request['tipo_dinheiro_id'];
        $divida->valor = $request['valor'];
        $divida->tipo = $request['tipo_divida'];
        if($request['ativo'] == true)
            $divida->ativo = 1;
        else
            $divida->ativo = 0;

        $divida->save();

        return redirect()->route('divida.index');
    }
  
    public function show($id)
    {
        $divida = Divida::get_divida($id, Auth::user()->id);
        return view('divida.detalhes',['obj' => $divida]);
    }
  
    public function edit($id)
    {
        $divida = Divida::get_divida($id, Auth::user()->id);
        $lista_tipo_dinheiros = Tipo_dinheiro::where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('divida.create_edit',['obj' => $divida, 'lista_tipo_dinheiros' => $lista_tipo_dinheiros]);
    }
  
    public function update(Request $request, $id)
    {
        $this->valida($request);

        $carteira = Carteira::findOrFail($request['carteira_id']);
        $carteira->nome = $request['nome'];
        $carteira->descricao = $request['descricao'];
        $carteira->usuario_id = $request['usuario_id'];
        $carteira->carteira_mestre_id = NULL;
        if($request['ativo'] == true)
            $carteira->ativo = 1;
        else
            $carteira->ativo = 0;

        $carteira->save();

        $divida= Divida::findOrFail($id);
        $divida->carteira_id = $request['carteira_id'];
        $divida->tipo_dinheiro_id = $request['tipo_dinheiro_id'];
        $divida->valor = $request['valor'];
        $divida->tipo = $request['tipo_divida'];
        if($request['ativo'] == true)
            $divida->ativo = 1;
        else
            $divida->ativo = 0;

        $divida->save();

        return redirect()->route('divida.index');
    }
  
    public function destroy($id)
    {
        $divida = Divida::findOrFail($id);
        $carteira = Carteira::findOrFail($divida->carteira_id);
        $divida->delete();
        $carteira->delete();

        return redirect()->route('divida.index');
    }

    public function desativar($id)
    {
        $divida = Divida::findOrFail($id);
        $carteira = Carteira::findOrFail($divida->carteira_id);
        $divida->ativo = 0;
        $carteira->ativo = 0;

        $divida->save();
        $carteira->save();
        return redirect()->route('divida.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'tipo_divida' => 'required',
            'tipo_dinheiro_id' => 'required',
        ],[
            'nome.required' => 'Preencha o nome da divida.',
            'descricao.required' => 'Preencha a descrição da divida.',
            'valor.required' => 'Preencha o valor da divida.',
            'tipo_divida.required' => 'Selecione o tipo da divida.',
            'tipo_dinheiro_id.required' => 'Selecione a moeda.',
        ]);
    }
}