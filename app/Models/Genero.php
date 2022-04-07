<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    // define o nome da tabela
    protected $table = 'genero';

    // quais atributos podem ser preenchidos 
    protected $fillable = ['codigo', 'descricao'];

    // diz para o Eloquent não criar o atributo created_at e deleted_at
    public $timestamps = false;
}
