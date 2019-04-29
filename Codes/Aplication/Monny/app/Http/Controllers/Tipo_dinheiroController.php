<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_dinheiro;

class Tipo_dinheiroController extends Controller
{
    public function index()
    {
        $lista_tipo_dinheiros = Tipo_dinheiro::get_tipo_dinheiro(0);
        
        return view('tipo_dinheiro.index',['lista_tipo_dinheiros' => $lista_tipo_dinheiros]);
    }
  
    public function create()
    {
    	$tipo_dinheiro = new Tipo_dinheiro;

        return view('tipo_dinheiro.create_edit',['obj' => $tipo_dinheiro]);
    }
  
    public function store(Request $request)
    {
        $this->valida($request);

        $tipo_dinheiro = new Tipo_dinheiro;
        $tipo_dinheiro->nome = $request['nome'];
        $tipo_dinheiro->sigla = $request['sigla'];
        if($request['ativo'] == true)
        	$tipo_dinheiro->ativo = 1;
        else
        	$tipo_dinheiro->ativo = 0;

        $tipo_dinheiro->save();

        return redirect()->route('tipo_dinheiro.index');
    }
  
    public function show($id)
    {
        $tipo_dinheiro = Tipo_dinheiro::findOrFail($id);
        return view('tipo_dinheiro.detalhes',['obj' => $tipo_dinheiro]);
    }
  
    public function edit($id)
    {
        $tipo_dinheiro = Tipo_dinheiro::get_tipo_dinheiro($id);

        return view('tipo_dinheiro.create_edit',['obj' => $tipo_dinheiro]);
    }
  
    public function update(Request $request, $id)
    {
        $this->valida($request);

        $tipo_dinheiro = Tipo_dinheiro::findOrFail($id);
        $tipo_dinheiro->nome = $request['nome'];
        $tipo_dinheiro->sigla = $request['sigla'];
        if($request['ativo'] == true)
        	$tipo_dinheiro->ativo = 1;
        else
        	$tipo_dinheiro->ativo = 0;

        $tipo_dinheiro->save();

        return redirect()->route('tipo_dinheiro.index');
    }
  
    public function destroy($id)
    {
        $tipo_dinheiro = Tipo_dinheiro::findOrFail($id);
        $tipo_dinheiro->delete();

        return redirect()->route('tipo_dinheiro.index');
    }

    public function desativar($id)
    {
        $tipo_dinheiro = Tipo_dinheiro::findOrFail($id);
        $tipo_dinheiro->ativo = 0;

        $tipo_dinheiro->save();
        return redirect()->route('tipo_dinheiro.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|regex:/^[\pL\s\-]+$/u',
            'sigla' => 'required',
        ],[
            'nome.required' => 'Preencha o nome da moeda.',
            'nome.regex' => 'O nome da moeda deve conter apenas letras.',
            'sigla.required' => 'Preencha a sigla da moeda.',
        ]);
    }
}