<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livros extends Model
{
    use HasFactory;

    // define o nome da tabela
    protected $table = 'livros';

    // quais atributos podem ser preenchidos 
    protected $fillable = ['codigoGenero', 'codigoLivro', 'titulo', 'descricao'];

    // diz para o Eloquent não criar o atributo created_at e deleted_at
    public $timestamps = false;
}
