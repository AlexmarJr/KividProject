<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cadastro extends Authenticatable
{
    use Notifiable;

    protected $table = 'cadastro';
    protected $fillable = [
        'name', 'telefone', 'endereco'
    ];

    public function saveInDB($request)
    {
        $this->name = $request->name;
        $this->telefone = $request->idioma;
        $this->endereco = $request->congregacao;
        $this->save();
    }
}