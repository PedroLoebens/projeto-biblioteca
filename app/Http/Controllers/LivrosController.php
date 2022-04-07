<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LivrosController extends Controller
{

    public function listaLivros(Request $request)
    {
        $listaLivros = Livros::all();

        // pega a mensagem da sessão da requisição
        $mensagem = $request->session()->get('mensagem');
        // após apaga a mensagem da sessão
        $request->session()->remove('mensagem');

        return view('lista-livros', [
            'listaLivros' => $listaLivros,
            'mensagem' => $mensagem
        ]);
    }

    public function cadastroLivros()
    {
        return view('cadastro-livros');
    }

    // public function editar(Request $request)
    // {
    //     $livros = Livros::find($request->id);

    //     return view('cadastro-livros', [
    //         "livros" => $livros
    //     ]);
    // }

    public function excluir(Request $request)
    {
        $livros = Livros::find($request->id);
        $livros->delete();

        $request->session()->put('mensagem', "Livro {$livros->id} excluido!");

        return redirect('/lista-livros');
    }

    public function salvarLivros(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'codigoGenero' => 'required|min:1|max:20',
            'codigoLivro' => 'required|min:1|max:20',
            'titulo' => 'required|min:1|max:55',
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
            $livros = Livros::find($request->id);
            $livros->codigoGenero = $request->codigoGenero;
            $livros->codigoLivro = $request->codigoLivro;
            $livros->titulo = $request->titulo;
            $livros->descricao = $request->descricao;
            $livros->save();

            // adiciona uma mensagem na sessão da requisição
            $request->session()->put('mensagem', "Livro {$livros->id} atualizado!");
        } else {
            // para que seja criada precisa ser adicionado como $fillable no modelo Tarefa.php exemplo:
            // 
            //  protected $fillable = ['codigo', 'descricao'];
            //
            //  
            $livros = Livros::create([
                'codigoGenero' => $request->codigoGenero,
                'codigoLivro' => $request->codigoLivro, // pega as informações da requisição
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
            ]);


            // adiciona uma mensagem na sessão da requisição
            $request->session()->put('mensagem', "Livro {$livros->id} criado!");
        }

        return redirect('/lista-livros');
    }
}
