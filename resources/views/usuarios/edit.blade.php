@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
        </div>
        <div class="mb-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" value="{{ $usuario->usuario }}" required>
        </div>
        <div class="mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control">
                <option value="Administrador" @if($usuario->rol=='Administrador') selected @endif>Administrador</option>
                <option value="Supervisor" @if($usuario->rol=='Supervisor') selected @endif>Supervisor</option>
                <option value="Operador" @if($usuario->rol=='Operador') selected @endif>Operador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
