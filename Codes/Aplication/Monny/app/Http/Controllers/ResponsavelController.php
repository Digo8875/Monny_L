<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsavel;

class ResponsavelController extends Controller
{
    public function index()
    {
        $lista_responsaveis = Responsavel::get_responsavel(0);
        
        return view('responsavel.index',['lista_responsaveis' => $lista_responsaveis]);
    }
  
    public function create()
    {
    	$responsavel = new Responsavel;

        return view('responsavel.create_edit',['obj' => $responsavel]);
    }
  
    public function store(Request $request)
    {
        $this->valida($request);

        $responsavel = new Responsavel;
        $responsavel->nome = $request['nome'];
        $responsavel->descricao = $request['descricao'];
        if($request['ativo'] == true)
        	$responsavel->ativo = 1;
        else
        	$responsavel->ativo = 0;

        $responsavel->save();

        return redirect()->route('responsavel.index');
    }
  
    public function show($id)
    {
        $responsavel = Responsavel::findOrFail($id);
        return view('responsavel.detalhes',['obj' => $responsavel]);
    }
  
    public function edit($id)
    {
        $responsavel = Responsavel::get_responsavel($id);

        return view('responsavel.create_edit',['obj' => $responsavel]);
    }
  
    public function update(Request $request, $id)
    {
        $this->valida($request);

        $responsavel = Responsavel::findOrFail($id);
        $responsavel->nome = $request['nome'];
        $responsavel->descricao = $request['descricao'];
        if($request['ativo'] == true)
        	$responsavel->ativo = 1;
        else
        	$responsavel->ativo = 0;

        $responsavel->save();

        return redirect()->route('responsavel.index');
    }
  
    public function destroy($id)
    {
        $responsavel = Responsavel::findOrFail($id);
        $responsavel->delete();

        return redirect()->route('responsavel.index');
    }

    public function desativar($id)
    {
        $responsavel = Responsavel::findOrFail($id);
        $responsavel->ativo = 0;

        $responsavel->save();
        return redirect()->route('responsavel.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|regex:/^[\pL\s\-]+$/u',
            'descricao' => 'required',
        ],[
            'nome.required' => 'Preencha o nome do responsavel.',
            'nome.regex' => 'O nome do responsavel deve conter apenas letras.',
            'descricao.required' => 'Preencha a descrição do responsavel.',
        ]);
    }
}