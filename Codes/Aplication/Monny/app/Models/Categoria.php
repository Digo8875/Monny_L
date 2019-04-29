<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = array('ativo','nome');

    protected $guarded = array('id');

    public $timestamps = true;

    public static function get_categoria($id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('categoria')
	    	        ->select('categoria.*')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('categoria')
	    	        ->select('categoria.*')
	    	        ->where('categoria.id', '=', $id)
	    	        ->first();

	    	return $result;
    }
}