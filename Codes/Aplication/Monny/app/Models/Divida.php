<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Divida extends Model
{
    protected $table = 'objetivo';

    protected $fillable = array('ativo','valor','tipo','carteira_id','tipo_dinheiro_id');

    protected $guarded = array('id');

    public $timestamps = true;

    public static function get_divida($id, $usuario_id)
    {

        if($id == 0)
        {
            $result = DB::table('objetivo')
                    ->join('carteira', 'carteira.id', '=', 'objetivo.carteira_id')
                    ->join('users', 'users.id', '=', 'carteira.usuario_id')
                    ->join('tipo_dinheiro', 'tipo_dinheiro.id', '=', 'objetivo.tipo_dinheiro_id')
                    ->select('objetivo.*', 'carteira.nome as nome', 'carteira.descricao as descricao', 'users.id as usuario_id', 'users.nome_pessoal as usuario_nome_pessoal', 'tipo_dinheiro.nome as tipo_dinheiro_nome', 'tipo_dinheiro.sigla as tipo_dinheiro_sigla')
                    ->where('objetivo.tipo', '=', 2)//2-Pagar
                    ->orWhere('objetivo.tipo', '=', 3)//3-Receber
                    ->where('users.id', '=', $usuario_id)
                    ->get();

            return $result;
        }

        $result = DB::table('objetivo')
                    ->join('carteira', 'carteira.id', '=', 'objetivo.carteira_id')
                    ->join('users', 'users.id', '=', 'carteira.usuario_id')
                    ->join('tipo_dinheiro', 'tipo_dinheiro.id', '=', 'objetivo.tipo_dinheiro_id')
                    ->select('objetivo.*', 'carteira.nome as nome', 'carteira.descricao as descricao', 'users.id as usuario_id', 'users.nome_pessoal as usuario_nome_pessoal', 'tipo_dinheiro.nome as tipo_dinheiro_nome', 'tipo_dinheiro.sigla as tipo_dinheiro_sigla')
                    ->where('objetivo.id', '=', $id)
                    ->where('users.id', '=', $usuario_id)
                    ->first();

            return $result;
    }
}