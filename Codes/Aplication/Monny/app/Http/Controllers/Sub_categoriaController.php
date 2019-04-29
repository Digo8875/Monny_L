<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub_categoria;
use App\Models\Categoria;

class Sub_categoriaController extends Controller
{
    public function index()
    {
        $lista_sub_categorias = Sub_categoria::get_sub_categoria(0);
        
        return view('sub_categoria.index',['lista_sub_categorias' => $lista_sub_categorias]);
    }
  
    public function create()
    {
    	$sub_categoria = new Sub_categoria;
        $lista_categorias = Categoria::where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('sub_categoria.create_edit',['obj' => $sub_categoria, 'lista_categorias' => $lista_categorias]);
    }
  
    public function store(Request $request)
    {
        $this->valida($request);

        $sub_categoria = new Sub_categoria;
        $sub_categoria->nome = $request['nome'];
        $sub_categoria->categoria_id = $request['categoria_id'];
        if($request['ativo'] == true)
        	$sub_categoria->ativo = 1;
        else
        	$sub_categoria->ativo = 0;

        $sub_categoria->save();

        return redirect()->route('sub_categoria.index');
    }
  
    public function show($id)
    {
        $sub_categoria = Sub_categoria::get_sub_categoria($id);
        return view('sub_categoria.detalhes',['obj' => $sub_categoria]);
    }
  
    public function edit($id)
    {
        $sub_categoria = Sub_categoria::get_sub_categoria($id);
        $lista_categorias = Categoria::where('ativo','=','1')->pluck('nome', 'id')->all();

        return view('sub_categoria.create_edit',['obj' => $sub_categoria, 'lista_categorias' => $lista_categorias]);
    }
  
    public function update(Request $request, $id)
    {
        $this->valida($request);

        $sub_categoria = Sub_categoria::findOrFail($id);
        $sub_categoria->nome = $request['nome'];
        $sub_categoria->categoria_id = $request['categoria_id'];
        if($request['ativo'] == true)
        	$sub_categoria->ativo = 1;
        else
        	$sub_categoria->ativo = 0;

        $sub_categoria->save();

        return redirect()->route('sub_categoria.index');
    }
  
    public function destroy($id)
    {
        $sub_categoria = Sub_categoria::findOrFail($id);
        $sub_categoria->delete();

        return redirect()->route('sub_categoria.index');
    }

    public function desativar($id)
    {
        $sub_categoria = Sub_categoria::findOrFail($id);
        $sub_categoria->ativo = 0;

        $sub_categoria->save();
        return redirect()->route('sub_categoria.index');
    }

    public function valida(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|regex:/^[\pL\s\-]+$/u',
        ],[
            'nome.required' => 'Preencha o nome da subcategoria.',
            'nome.regex' => 'O nome da subcategoria deve conter apenas letras.',
        ]);
    }
}