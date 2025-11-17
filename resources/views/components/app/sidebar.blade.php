@props(['genres' => []])

<aside
    class="fixed top-0 left-0 h-screen w-20 bg-black bg-opacity-20 backdrop-blur-sm z-50 flex flex-col items-center py-2 items-start shadow-xl transition-all duration-300 hover:w-48 group">

    <!-- Sección de Perfil y Nombre -->
    <div class="mb-10 flex flex-col items-center">
        <a href="{{ route('profile') }}"
            class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-lg font-bold hover:bg-purple-700 transition duration-300"
            title="{{ Auth::user()->name }}">
            M
        </a>
        <span
            class="mt-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap text-white">
            {{ Auth::user()->name }}
        </span>
    </div>

    <nav class="flex flex-col items-center space-y-12 mt-40 justify-center w-full">

        <!-- --- ENLACES ESTÁTICOS --- -->

        <!-- Inicio/Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center space-x-4 p-2 rounded-lg text-gray-300 hover:text-white hover:bg-purple-700/50 transition duration-300 w-16 group-hover:w-full group-hover:px-4"
            title="Inicio">
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span
                class="text-sm opacity-0 group-hover:opacity-100 group-hover:relative group-hover:left-0 transition-opacity duration-300 whitespace-nowrap">
                Inicio
            </span>
        </a>

        <!-- Recomendados -->
        <a href="{{ route('catalog.show', ['category' => 'recomendados']) }}"
            class="flex items-center space-x-4 p-2 rounded-lg text-gray-300 hover:text-white hover:bg-purple-700/50 transition duration-300 w-16 group-hover:w-full group-hover:px-4"
            title="Recomendados">
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
            </svg>
            <span
                class="text-sm opacity-0 group-hover:opacity-100 group-hover:relative group-hover:left-0 transition-opacity duration-300 whitespace-nowrap">
                Recomendados
            </span>
        </a>

        <!-- Lo Nuevo -->
        <a href="{{ route('catalog.show', ['category' => 'nuevo']) }}"
            class="flex items-center space-x-4 p-2 rounded-lg text-gray-300 hover:text-white hover:bg-purple-700/50 transition duration-300 w-16 group-hover:w-full group-hover:px-4"
            title="Lo Nuevo">
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            <span
                class="text-sm opacity-0 group-hover:opacity-100 group-hover:relative group-hover:left-0 transition-opacity duration-300 whitespace-nowrap">
                Lo Nuevo
            </span>
        </a>

        <!-- Tendencia -->
        <a href="{{ route('catalog.show', ['category' => 'tendencias']) }}"
            class="flex items-center space-x-4 p-2 rounded-lg text-gray-300 hover:text-white hover:bg-purple-700/50 transition duration-300 w-16 group-hover:w-full group-hover:px-4"
            title="Tendencia">
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
            </svg>
            <span
                class="text-sm opacity-0 group-hover:opacity-100 group-hover:relative group-hover:left-0 transition-opacity duration-300 whitespace-nowrap">
                Tendencia
            </span>
        </a>

        <!-- Separador -->
        <div class="w-full border-t border-gray-700 my-4 pt-4"></div>

        <!-- --- NUEVO: LISTADO DINÁMICO DE GÉNEROS --- -->

        @php
            // Asegúrese de tener 'use App\Models\Genre;' en algún lugar de su archivo Blade si es un componente de Blade completo
            // Si es un componente simple (x-component), esta línea es necesaria para acceder a la clase.
            $genres = \App\Models\Genre::orderBy('name')->get();
        @endphp

        <p
            class="text-sm font-semibold text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap w-full pl-4">
            GÉNEROS</p>

        @foreach ($genres as $genre)
            <a href="{{ route('catalog.show', ['category' => strtolower($genre->name)]) }}"
                class="flex items-center space-x-4 p-2 rounded-lg text-gray-300 hover:text-white hover:bg-red-700/50 transition duration-300 w-16 group-hover:w-full group-hover:px-4"
                title="{{ $genre->name }}">
                <svg class="w-7 h-7 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6">
                    </path>
                </svg>
                <span
                    class="text-sm opacity-0 group-hover:opacity-100 group-hover:relative group-hover:left-0 transition-opacity duration-300 whitespace-nowrap">
                    {{ $genre->name }}
                </span>
            </a>
        @endforeach
        <!-- --- FIN LISTADO DINÁMICO --- -->

    </nav>

    <!-- Cerrar Sesión (al final) -->
    <form method="POST" action="{{ route('logout') }}" class="absolute bottom-6">
        @csrf
        <button type="submit"
            class="flex items-center space-x-4 p-2 rounded-lg text-gray-300 hover:text-white hover:bg-red-700/50 transition duration-300"
            title="Cerrar Sesión">

            <svg class="w-7 h-7 flex-shrink-0 mx-auto group-hover:mx-0 transition-all duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                </path>
            </svg>

            <span class="text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Cerrar Sesión
            </span>
        </button>
    </form>


</aside>
