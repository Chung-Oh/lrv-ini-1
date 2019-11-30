@extends('layouts.layout')

@section('content')
    <h3>Editar cliente</h3>
    @include('form._form_errors')
    <form method="post" action="{{route('clients.update', ['client' => $client->id])}}">
        <!-- Abaixo 2 formas de se enviar com método PUT -->
        <!-- 1º HTML -->
        <!-- <input type="hidden" name="_method" value="PUT"> -->
        <!-- Laravel -->
        {{method_field('PUT')}}
        @include('admin.clients._form')
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection