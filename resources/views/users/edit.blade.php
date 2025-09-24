@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Contraseña (dejar vacío para no cambiar)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control" required>
                <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="operador" {{ $user->rol == 'operador' ? 'selected' : '' }}>Operador</option>
                <option value="supervisor" {{ $user->rol == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="activo" {{ $user->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $user->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
