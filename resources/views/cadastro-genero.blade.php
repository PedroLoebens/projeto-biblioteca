

@extends('layout')

@section('titulo')
    <a class="navbar-brand" href="/lista-genero/cadastro-genero"><strong>Cadastro de Gênero</strong></a>
@endsection

@section('conteudo')
          
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/lista-genero/cadastro-genero" method="POST">
            
            <!-- o csrf é uma proteção de cors origem que o proprio laravel implemente -->
            @csrf

            <input type="hidden" name="id" value="{{isset($genero) ? $genero->id : old('id')}}" />

            <div class="mb-3">
                <label for="formTitulo" class="form-label">Código do gênero</label>
                <input class="form-control" type="number" id="formTitulo" name="codigo" value="{{isset($genero) ? $genero->codigo : old('codigo')}}" placeholder="Digite um número para o código">
            </div>
            <div class="mb-3">
                <label for="formDescricao" class="form-label">Descrição do gênero</label>
                <textarea class="form-control" type="text" id="formDescricao" name="descricao" placeholder="Digite uma descrição">{{isset($genero) ? $genero->descricao : old('descricao')}}</textarea>
            </div>

            

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>

                <a type="button" class="btn btn-secondary" href="/lista-genero">Cancelar</a>
            </div>
        </form>
       

@endsection

