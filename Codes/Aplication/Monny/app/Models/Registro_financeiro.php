<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Registro_financeiro extends Model
{
    protected $table = 'registro_financeiro';

    protected $fillable = array('nome','descricao','valor','tipo','doacao','ativo','data_pagamento','responsavel_id','sub_categoria_id','tipo_dinheiro_id','agendamento_financeiro_id');

    protected $guarded = array('id');

    public $timestamps = true;

    public static function get_registro_financeiro($id, $usuario_id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('registro_financeiro')
                    ->join('cart_reg_fin', 'cart_reg_fin.registro_financeiro_id', '=', 'registro_financeiro.id')
                    ->join('carteira as cart', 'cart.id', '=', 'cart_reg_fin.carteira_id')
                    ->join('users', 'users.id', '=', 'cart.usuario_id')
                    ->join('tipo_dinheiro', 'tipo_dinheiro.id', '=', 'registro_financeiro.tipo_dinheiro_id')
                    ->join('sub_categoria', 'sub_categoria.id', '=', 'registro_financeiro.sub_categoria_id')
                    ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')
                    ->leftJoin('carteira as divida', 'divida.id', '=', 'cart_reg_fin.divida_id')
                    ->leftJoin('responsavel', 'responsavel.id', '=', 'registro_financeiro.responsavel_id')
                    ->leftJoin('agendamento_financeiro', 'agendamento_financeiro.id', '=', 'registro_financeiro.agendamento_financeiro_id')
                    ->select('registro_financeiro.*', 'cart_reg_fin.id as cart_reg_fin_id', 'cart.id as carteira_id', 'users.id as usuario_id', 'users.nome_pessoal as usuario_nome_pessoal', 'divida.id as divida_id', 'responsavel.nome as responsavel_nome')
                    ->where('users.id', '=', $usuario_id)
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('registro_financeiro')
                    ->join('cart_reg_fin', 'cart_reg_fin.registro_financeiro_id', '=', 'registro_financeiro.id')
                    ->join('carteira as cart', 'cart.id', '=', 'cart_reg_fin.carteira_id')
                    ->join('users', 'users.id', '=', 'cart.usuario_id')
                    ->join('tipo_dinheiro', 'tipo_dinheiro.id', '=', 'registro_financeiro.tipo_dinheiro_id')
                    ->join('sub_categoria', 'sub_categoria.id', '=', 'registro_financeiro.sub_categoria_id')
                    ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')
                    ->leftJoin('carteira as divida', 'divida.id', '=', 'cart_reg_fin.divida_id')
                    ->leftJoin('responsavel', 'responsavel.id', '=', 'registro_financeiro.responsavel_id')
                    ->leftJoin('agendamento_financeiro', 'agendamento_financeiro.id', '=', 'registro_financeiro.agendamento_financeiro_id')
                    ->select('registro_financeiro.*', 'cart_reg_fin.id as cart_reg_fin_id', 'cart.id as carteira_id', 'users.id as usuario_id', 'users.nome_pessoal as usuario_nome_pessoal', 'divida.id as divida_id', 'responsavel.nome as responsavel_nome')
	    	        ->where('registro_financeiro.id', '=', $id)
                    ->where('users.id', '=', $usuario_id)
	    	        ->first();

	    	return $result;
    }
}