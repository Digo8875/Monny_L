<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Objetivo;
use App\Models\Carteira;
use App\Models\Tipo_dinheiro;

class ObjetivoController extends Controller
{
    public function index()
    {
        $lista_objetivos = Objetivo::get_objetivo(0, Auth::user()->id);
        
        return view('objetivo.index',['lista_objetivos' => $lista_objetivos]);
    }
  
    public function create()
    {
    	$objetivo = new Objetivo;
        $lista_tipo_dinheiros = Tipo_dinheiro::where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('objetivo.create_edit',['obj' => $objetivo, 'lista_tipo_dinheiros' => $lista_tipo_dinheiros]);
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

        $objetivo= new Objetivo;
        $objetivo->carteira_id = $carteira_id;
        $objetivo->tipo_dinheiro_id = $request['tipo_dinheiro_id'];
        $objetivo->valor = $request['valor'];
        $objetivo->tipo = 1; //1-Guardar
        if($request['ativo'] == true)
            $objetivo->ativo = 1;
        else
            $objetivo->ativo = 0;

        $objetivo->save();

        return redirect()->route('objetivo.index');
    }
  
    public function show($id)
    {
        $objetivo = Objetivo::get_objetivo($id, Auth::user()->id);
        return view('objetivo.detalhes',['obj' => $objetivo]);
    }
  
    public function edit($id)
    {
        $objetivo = Objetivo::get_objetivo($id, Auth::user()->id);
        $lista_tipo_dinheiros = Tipo_dinheiro::where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('objetivo.create_edit',['obj' => $objetivo, 'lista_tipo_dinheiros' => $lista_tipo_dinheiros]);
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

        $objetivo= Objetivo::findOrFail($id);
        $objetivo->carteira_id = $request['carteira_id'];
        $objetivo->tipo_dinheiro_id = $request['tipo_dinheiro_id'];
        $objetivo->valor = $request['valor'];
        $objetivo->tipo = 1; //1-Guardar
        if($request['ativo'] == true)
            $objetivo->ativo = 1;
        else
            $objetivo->ativo = 0;

        $objetivo->save();

        return redirect()->route('objetivo.index');
    }
  
    public function destroy($id)
    {
        $objetivo = Objetivo::findOrFail($id);
        $carteira = Carteira::findOrFail($objetivo->carteira_id);
        $objetivo->delete();
        $carteira->delete();

        return redirect()->route('objetivo.index');
    }

    public function desativar($id)
    {
        $objetivo = Objetivo::findOrFail($id);
        $carteira = Carteira::findOrFail($objetivo->carteira_id);
        $objetivo->ativo = 0;
        $carteira->ativo = 0;

        $objetivo->save();
        $carteira->save();
        return redirect()->route('objetivo.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'tipo_dinheiro_id' => 'required',
        ],[
            'nome.required' => 'Preencha o nome do objetivo.',
            'descricao.required' => 'Preencha a descrição do objetivo.',
            'valor.required' => 'Preencha o valor do objetivo.',
            'tipo_dinheiro_id.required' => 'Selecione a moeda.',
        ]);
    }
}