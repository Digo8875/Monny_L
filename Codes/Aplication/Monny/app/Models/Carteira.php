<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Carteira extends Model
{
    protected $table = 'carteira';

    protected $fillable = array('ativo','nome','descricao','carteira_mestre_id','usuario_id');

    protected $guarded = array('id');

    public $timestamps = true;

    public static function get_carteira($id, $usuario_id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('carteira as cart')
                    ->leftJoin('carteira as cart2', 'cart2.id', '=', 'cart.carteira_mestre_id')
	    	        ->join('users', 'users.id', '=', 'cart.usuario_id')
                    ->leftJoin('objetivo', 'objetivo.carteira_id', '=', 'cart.id')
                    ->select('cart.*', 'cart2.nome as carteira_mestre_nome', 'users.id as usuario_id', 'users.nome_pessoal as usuario_nome_pessoal')
                    ->where('objetivo.carteira_id', '=', NULL)
                    ->where('users.id', '=', $usuario_id)
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('carteira as cart')
                    ->leftJoin('carteira as cart2', 'cart2.id', '=', 'cart.carteira_mestre_id')
                    ->join('users', 'users.id', '=', 'cart.usuario_id')
                    ->leftJoin('objetivo', 'objetivo.carteira_id', '=', 'cart.id')
                    ->select('cart.*', 'cart2.nome as carteira_mestre_nome', 'users.id as usuario_id', 'users.nome_pessoal as usuario_nome_pessoal')
                    ->where('objetivo.carteira_id', '=', NULL)
	    	        ->where('cart.id', '=', $id)
                    ->where('users.id', '=', $usuario_id)
	    	        ->first();

	    	return $result;
    }
}