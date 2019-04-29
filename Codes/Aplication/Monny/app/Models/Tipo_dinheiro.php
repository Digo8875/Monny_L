<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tipo_dinheiro extends Model
{
    protected $table = 'tipo_dinheiro';

    protected $fillable = array('ativo','nome','sigla');

    protected $guarded = array('id');

    public $timestamps = true;

    public static function get_tipo_dinheiro($id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('tipo_dinheiro')
	    	        ->select('tipo_dinheiro.*')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('tipo_dinheiro')
	    	        ->select('tipo_dinheiro.*')
	    	        ->where('tipo_dinheiro.id', '=', $id)
	    	        ->first();

	    	return $result;
    }
}