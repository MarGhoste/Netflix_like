@props(['sidebarGenres' => []])

{{-- Nota: Se asume que Str Facade está disponible en su entorno Blade. --}}
@php
    use Illuminate\Support\Str;
@endphp

<style>
    /* Ocultar scrollbar pero mantener funcionalidad */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<aside
    class="fixed top-0 left-0 h-screen w-20 bg-black/90 backdrop-blur-md z-50 flex flex-col py-6 shadow-2xl transition-all duration-300 ease-in-out hover:w-64 group border-r border-gray-800">

    <!-- Sección de Perfil -->
    <div class="mb-8 flex flex-col items-center px-4 w-full">
        <a href="{{ route('profile') }}"
            class="relative w-10 h-10 rounded-md bg-gradient-to-br from-red-600 to-red-700 flex items-center justify-center text-lg font-bold hover:from-red-500 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-red-500/50 group/avatar"
            title="{{ Auth::user()->name }}">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            <span class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-black"></span>
        </a>
        <span
            class="mt-3 text-sm font-medium opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap text-white">
            {{ Str::limit(Auth::user()->name, 20) }}
        </span>
    </div>

    <!-- Navegación Principal -->
    <nav class="flex-1 flex flex-col space-y-2 px-3 overflow-y-auto scrollbar-hide">

        <!-- ENLACES PRINCIPALES -->

        <!-- Inicio -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-400 hover:text-red-400 hover:bg-white/10 transition-all duration-200 group/item"
            title="Inicio">
            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span
                class="text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Inicio
            </span>
        </a>

        <!-- Recomendados -->
        <a href="{{ route('catalog.show', ['category' => 'recomendados']) }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-400 hover:text-red-400 hover:bg-white/10 transition-all duration-200 group/item"
            title="Recomendados">
            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
            </svg>
            <span
                class="text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Recomendados
            </span>
        </a>

        <!-- Lo Nuevo -->
        <a href="{{ route('catalog.show', ['category' => 'nuevo']) }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-400 hover:text-red-400 hover:bg-white/10 transition-all duration-200 group/item"
            title="Lo Nuevo">
            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
            </svg>
            <span
                class="text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Lo Nuevo
            </span>
        </a>

        <!-- Tendencias -->
        <a href="{{ route('catalog.show', ['category' => 'tendencias']) }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-400 hover:text-red-400 hover:bg-white/10 transition-all duration-200 group/item"
            title="Tendencias">
            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
            </svg>
            <span
                class="text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Tendencias
            </span>
        </a>

        <!-- Separador -->
        <div class="border-t border-gray-800 my-4"></div>

        <!-- Sección de Géneros -->
        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3 mb-2">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Géneros</p>
        </div>

        <!-- Lista de Géneros (Iteración sobre la prop $genres) -->
        @foreach ($sidebarGenres as $genre)
            <a href="{{ route('catalog.show', ['category' => Str::slug($genre->name)]) }}"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-400 hover:text-red-400 hover:bg-white/10 transition-all duration-200 group/item"
                title="{{ $genre->name }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z">
                    </path>
                </svg>
                <span
                    class="text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    {{ $genre->name }}
                </span>
            </a>
        @endforeach

    </nav>

    <!-- Footer: Cerrar Sesión -->
    <div class="px-3 pt-4 border-t border-gray-800 mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200 w-full group/logout"
                title="Cerrar Sesión">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m0 3H9">
                    </path>
                </svg>
                <span
                    class="text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Cerrar Sesión
                </span>
            </button>
        </form>
    </div>

</aside>
