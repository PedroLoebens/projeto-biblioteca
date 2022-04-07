<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GeneroController extends Controller
{

    public function listaGenero(Request $request)
    {
        $listaGenero = Genero::all();

        // pega a mensagem da sessão da requisição
        $mensagem = $request->session()->get('mensagem');
        // após apaga a mensagem da sessão
        $request->session()->remove('mensagem');

        return view('lista-genero', [
            'listaGenero' => $listaGenero,
            'mensagem' => $mensagem
        ]);
    }

    public function cadastroGenero()
    {
        return view('cadastro-genero');
    }

    // public function editar(Request $request)
    // {
    //     $genero = Genero::find($request->id);

    //     return view('cadastro-genero', [
    //         "genero" => $genero
    //     ]);
    // }

    public function excluir(Request $request)
    {
        $genero = Genero::find($request->id);
        $genero->delete();

        $request->session()->put('mensagem', "Gênero {$genero->id} excluido!");

        return redirect('/lista-genero');
    }

    public function salvarGenero(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'codigo' => 'required|min:1|max:20',
            'descricao' => 'required'
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
            'max' => 'O campo :attribute precisa ter no máximo :max caracteres'
        ]);
 
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }


        
        
        if ($request->id != null) {
            $genero = Genero::find($request->id);
            $genero->codigo = $request->codigo;
            $genero->descricao = $request->descricao;
            $genero->save();

            // adiciona uma mensagem na sessão da requisição
            $request->session()->put('mensagem', "Gênero {$genero->id} atualizado!");
        } else {
            // para que seja criada precisa ser adicionado como $fillable no modelo Tarefa.php exemplo:
            // 
            //  protected $fillable = ['codigo', 'descricao'];
            //
            //  
            $genero = Genero::create([
                'codigo' => $request->codigo, // pega as informações da requisição
                'descricao' => $request->descricao
            ]);


            // adiciona uma mensagem na sessão da requisição
            $request->session()->put('mensagem', "Gênero {$genero->id} criado!");
        }

        return redirect('/lista-genero');
    }
}
