<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'usuario';

    protected $fillable = array('id', 'nome_pessoal', 'nome_usuario', 'ativo', 'password', 'email');

    protected $hidden = array('password', 'remember_token');

    protected $casts = array('email_verified_at' => 'datetime');
}