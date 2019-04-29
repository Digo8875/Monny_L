<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $lista_categorias = Categoria::get_categoria(0);
        
        return view('categoria.index',['lista_categorias' => $lista_categorias]);
    }
  
    public function create()
    {
    	$categoria = new Categoria;

        return view('categoria.create_edit',['obj' => $categoria]);
    }
  
    public function store(Request $request)
    {
        $this->valida($request);

        $categoria = new Categoria;
        $categoria->nome = $request['nome'];
        if($request['ativo'] == true)
        	$categoria->ativo = 1;
        else
        	$categoria->ativo = 0;

        $categoria->save();

        return redirect()->route('categoria.index');
    }
  
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.detalhes',['obj' => $categoria]);
    }
  
    public function edit($id)
    {
        $categoria = Categoria::get_categoria($id);

        return view('categoria.create_edit',['obj' => $categoria]);
    }
  
    public function update(Request $request, $id)
    {
        $this->valida($request);

        $categoria = Categoria::findOrFail($id);
        $categoria->nome = $request['nome'];
        if($request['ativo'] == true)
        	$categoria->ativo = 1;
        else
        	$categoria->ativo = 0;

        $categoria->save();

        return redirect()->route('categoria.index');
    }
  
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categoria.index');
    }

    public function desativar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->ativo = 0;

        $categoria->save();
        return redirect()->route('categoria.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|regex:/^[\pL\s\-]+$/u',
        ],[
            'nome.required' => 'Preencha o nome da categoria.',
            'nome.regex' => 'O nome da categoria deve conter apenas letras.',
        ]);
    }
}