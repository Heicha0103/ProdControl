<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProdControl - Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
        }
        .input-field {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.75rem;
            width: 100%;
            margin-top: 0.25rem;
        }
        .input-field:focus {
            outline: none;
            ring: 2px;
            ring-color: #10b981;
            border-color: #10b981;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <div class="flex flex-col items-center justify-center text-center">
            <div class="w-16 h-30 rounded-full flex items-center justify-center text-white font-bold text-xl mb-2">
                <a href="/">
                    <x-application-logo class="w-15 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <h1 class="font-bold text-xl text-gray-800">ProdControl</h1>
        </div>

        <form method="POST" action="#">
            @csrf

            <div class="mt-6">
                <input 
                    id="email" 
                    class="input-field"
                    type="email"
                    name="email"
                    placeholder="Correo electrónico"
                    required autofocus autocomplete="username" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <input 
                    id="password" 
                    class="input-field"
                    type="password"
                    name="password"
                    placeholder="Contraseña"
                    required autocomplete="current-password" />
            </div>

            <!-- Remember Me y Olvidé contraseña -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-green-700 focus:ring-green-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-700">{{ __('Recuérdame') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-sm text-green-700 hover:text-green-900"  href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
                @endif
            </div>


            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-medium py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                    Iniciar Sesión
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <span class="text-sm text-gray-600">¿No tienes una cuenta? </span>
            <a href="#" class="text-sm text-green-700 hover:text-green-900 font-medium">Regístrate</a>
        </div>
    </div>
</body>
</html>