<div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 items-start sm:items-center">

    {{-- NOTIFICACIONES (Mostrarán mensajes flash) --}}
    @if (session()->has('error_rating') || session()->has('error_favorite'))
        <div class="p-3 text-sm text-red-400 bg-red-900/50 rounded-lg w-full sm:w-auto" role="alert">
            {{ session('error_rating') ?? session('error_favorite') }}
        </div>
    @elseif (session()->has('message_favorite'))
        <div class="p-3 text-sm text-yellow-400 bg-yellow-900/50 rounded-lg w-full sm:w-auto" role="alert">
            {{ session('message_favorite') }}
        </div>
    @endif

    {{-- GRUPO DE VOTOS (Like/Dislike) --}}
    <div class="flex space-x-4">

        {{-- Botón Like (Voto Positivo) --}}
        {{-- Llama a vote(1). Si el voto es 1, también añade a Mi Lista. --}}
        <button wire:click="vote(1)"
            class="flex items-center px-4 py-2 rounded-full font-bold transition duration-150 shadow-md
                       {{ $userVote === 1 ? 'bg-purple-600 text-white shadow-purple-500/50' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">

            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M2 10.5a1.5 1.5 0 113 0v5a1.5 1.5 0 11-3 0v-5zM6.656 12.01a.75.75 0 010-1.06l3.894-3.894a.75.75 0 011.06 0l3.894 3.894a.75.75 0 010 1.06l-.75.75a.75.75 0 01-1.06 0l-2.618-2.618v6.773a.75.75 0 01-1.5 0V10.192l-2.618 2.618a.75.75 0 01-1.06 0l-.75-.75z" />
            </svg>
            <span class="ml-1">{{ $likesCount }}</span>
        </button>

        {{-- Botón Dislike (Voto Negativo) --}}
        {{-- Llama a vote(-1). Si estaba en Mi Lista, la quita. --}}
        <button wire:click="vote(-1)"
            class="flex items-center px-4 py-2 rounded-full font-bold transition duration-150 shadow-md
                       {{ $userVote === -1 ? 'bg-purple-600 text-white shadow-purple-500/50' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}">

            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M18 9.5a1.5 1.5 0 11-3 0v-5a1.5 1.5 0 113 0v5zM13.344 7.99a.75.75 0 010 1.06l-3.894 3.894a.75.75 0 01-1.06 0l-3.894-3.894a.75.75 0 010-1.06l.75-.75a.75.75 0 011.06 0l2.618 2.618V3.75a.75.75 0 011.5 0v6.773l2.618-2.618a.75.75 0 011.06 0l.75.75z" />
            </svg>
            <span class="ml-1">{{ $dislikesCount }}</span>
        </button>
    </div>

    {{-- NUEVO BOTÓN DE MI LISTA (Llama a toggleFavorite() sin argumentos) --}}
    <button wire:click="toggleFavorite"
        class="flex items-center justify-center px-6 py-3 font-semibold text-lg rounded-full shadow-lg 
                   transition duration-300 border 
                   {{ $isFavorite ? 'bg-yellow-500 border-yellow-400 text-black hover:bg-yellow-600' : 'bg-gray-700 border-gray-600 text-gray-200 hover:bg-gray-600' }}">

        {{-- Icono de Corazón --}}
        <svg class="w-6 h-6 mr-2 fill-current {{ $isFavorite ? 'text-purple-700' : 'text-gray-200' }}"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>

        <span class="font-extrabold">
            @if ($isFavorite)
                En Mi Lista
            @else
                + Mi Lista
            @endif
        </span>
    </button>
</div>
