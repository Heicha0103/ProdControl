{{-- resources/views/components/app-layout.blade.php --}}
<div class="min-h-screen bg-gray-100">
    {{-- Header --}}
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Page Content --}}
    <main>
        {{ $slot }}
    </main>
</div>
