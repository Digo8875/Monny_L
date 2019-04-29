<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sub_categoria extends Model
{
    protected $table = 'sub_categoria';

    protected $fillable = array('ativo','nome','categoria_id');

    protected $guarded = array('id');

    public $timestamps = true;

    public static function get_sub_categoria($id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('sub_categoria')
                    ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')
	    	        ->select('sub_categoria.*', 'categoria.id as categoria_id', 'categoria.nome as categoria_nome')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('sub_categoria')
	    	        ->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')
                    ->select('sub_categoria.*', 'categoria.id as categoria_id', 'categoria.nome as categoria_nome')
	    	        ->where('sub_categoria.id', '=', $id)
	    	        ->first();

	    	return $result;
    }

}