@extends('layout')

@section('titulo')
    <a class="navbar-brand" href="/lista-pessoas/cadastro-pessoas"><strong>Cadastro de Pessoas</strong></a>
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

        <form action="/lista-pessoas/cadastro-pessoas" method="POST">
            <!-- o csrf é uma proteção de cors origem que o proprio laravel implemente -->
            @csrf

            <input type="hidden" name="id" value="{{isset($pessoas) ? $pessoas->id : old('id')}}" />

            <div class="mb-3">
                <label for="formTitulo" class="form-label">Código</label>
                <input class="form-control" type="number" id="codigo" name="codigo" value="{{isset($pessoas) ? $pessoas->codigo : old('codigo')}}" placeholder="Digite o código da Pessoa">
            </div>
            <div class="mb-3">
                <label for="formTitulo" class="form-label">Nome</label>
                <input class="form-control" type="text" id="nome" name="nome" value="{{isset($pessoas) ? $pessoas->nome : old('nome')}}" placeholder="Digite o nome da Pessoa">
            </div>
            <div class="mb-3">
                <label for="formDescricao" class="form-label">Endereço</label>
                <textarea class="form-control" type="text" id="formEndereco" name="endereco" placeholder="Digite o Enderoço">{{isset($pessoas) ? $pessoas->endereco : old('endereco')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="formTitulo" class="form-label">Telefone</label>
                <input class="form-control" type="text" id="telefone" name="telefone" value="{{isset($pessoas) ? $pessoas->telefone : old('telefone')}}" placeholder="Digite o telefone da Pessoa">
            </div>
            <div class="mb-3">
                <label for="formTitulo" class="form-label">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{isset($pessoas) ? $pessoas->email : old('email')}}" placeholder="Digite o email da Pessoa">
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>

                <a type="button" class="btn btn-secondary" href="/lista-pessoas">Cancelar</a>
            </div>
        </form>   
    </div>
@endsection
