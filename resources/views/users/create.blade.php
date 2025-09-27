@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Encabezado -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Crear Usuario</h1>
            <p class="text-gray-600 mt-1">Completa los campos para registrar un nuevo usuario</p>
        </div>

        <!-- Mensaje de errores -->
        @if($errors->any())
        <div class="rounded-md bg-red-50 p-4 mb-6">
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
            </div>

            <!-- Contraseña -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
            </div>

            <!-- Rol -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="rol" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
                    <option value="admin">Admin</option>
                    <option value="operador" selected>Operador</option>
                    <option value="supervisor">Supervisor</option>
                </select>
            </div>

            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
                    <option value="activo" selected>Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('users.index') }}" 
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg shadow text-gray-800">Cancelar</a>
                <button type="submit" 
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
