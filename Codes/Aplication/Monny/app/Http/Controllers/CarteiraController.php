<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Carteira;

class CarteiraController extends Controller
{
    public function index()
    {
        $lista_carteiras = Carteira::get_carteira(0, Auth::user()->id);
        
        return view('carteira.index',['lista_carteiras' => $lista_carteiras]);
    }
  
    public function create()
    {
    	$carteira = new Carteira;
        $lista_carteiras_mestre = Carteira::get_carteira(0, Auth::user()->id)->where('ativo','=','1')->where('usuario_id','=',Auth::user()->id)->pluck('nome', 'id')->all();

        return view('carteira.create_edit',['obj' => $carteira, 'lista_carteiras_mestre' => $lista_carteiras_mestre]);
    }
  
    public function store(Request $request)
    {
        $this->valida($request);

        $carteira = new Carteira;
        $carteira->nome = $request['nome'];
        $carteira->descricao = $request['descricao'];
        $carteira->usuario_id = $request['usuario_id'];
        if($request['carteira_mestre_id'] != 0)
            $carteira->carteira_mestre_id = $request['carteira_mestre_id'];
        if($request['ativo'] == true)
        	$carteira->ativo = 1;
        else
        	$carteira->ativo = 0;

        $carteira->save();

        return redirect()->route('carteira.index');
    }
  
    public function show($id)
    {
        $carteira = Carteira::get_carteira($id, Auth::user()->id);
        return view('carteira.detalhes',['obj' => $carteira]);
    }
  
    public function edit($id)
    {
        $carteira = Carteira::get_carteira($id, Auth::user()->id);
        $lista_carteiras_mestre = Carteira::get_carteira(0, Auth::user()->id)->where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('carteira.create_edit',['obj' => $carteira, 'lista_carteiras_mestre' => $lista_carteiras_mestre]);
    }
  
    public function update(Request $request, $id)
    {
        $this->valida($request);

        $carteira = Carteira::findOrFail($id);
        $carteira->nome = $request['nome'];
        $carteira->descricao = $request['descricao'];
        $carteira->usuario_id = $request['usuario_id'];
        if($request['carteira_mestre_id'] != 0)
            $carteira->carteira_mestre_id = $request['carteira_mestre_id'];
        else
            $carteira->carteira_mestre_id = NULL;
        if($request['ativo'] == true)
            $carteira->ativo = 1;
        else
            $carteira->ativo = 0;

        $carteira->save();

        return redirect()->route('carteira.index');
    }
  
    public function destroy($id)
    {
        $carteira = Carteira::findOrFail($id);
        $carteira->delete();

        return redirect()->route('carteira.index');
    }

    public function desativar($id)
    {
        $carteira = Carteira::findOrFail($id);
        $carteira->ativo = 0;

        $carteira->save();
        return redirect()->route('carteira.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|regex:/^[\pL\s\-]+$/u',
            'descricao' => 'required',
        ],[
            'nome.required' => 'Preencha o nome da carteira.',
            'nome.regex' => 'O nome da carteira deve conter apenas letras.',
            'descricao.required' => 'Preencha a descrição da carteira.',
        ]);
    }
}