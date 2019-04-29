<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Responsavel extends Model
{
    protected $table = 'responsavel';

    protected $fillable = array('ativo','nome','descricao');

    protected $guarded = array('id');

    public $timestamps = true;

    public static function get_responsavel($id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('responsavel')
	    	        ->select('responsavel.*')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('responsavel')
	    	        ->select('responsavel.*')
	    	        ->where('responsavel.id', '=', $id)
	    	        ->first();

	    	return $result;
    }
}