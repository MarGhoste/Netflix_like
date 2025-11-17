<div class="flex space-x-4">

    {{-- Botón ME GUSTA --}}
    <button wire:click="vote(1)"
        class="flex items-center px-6 py-3 font-semibold rounded-full transition duration-300
               {{ $userVote === 1 ? 'bg-green-600 text-white shadow-lg' : 'bg-gray-700 text-green-400 hover:bg-gray-600' }}"
        title="Me Gusta">

        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM10 2.5a1 1 0 00-1 1v10.5a1 1 0 001 1h6.5a2 2 0 001.995-1.858L19.017 7.5A2 2 0 0017.017 5H13.858a2 2 0 00-1.858-1.995L10 2.5z" />
        </svg>
        Me Gusta ({{ $likesCount }})
    </button>

    {{-- Botón NO ME GUSTA --}}
    <button wire:click="vote(-1)"
        class="flex items-center px-6 py-3 font-semibold rounded-full transition duration-300
               {{ $userVote === -1 ? 'bg-red-600 text-white shadow-lg' : 'bg-gray-700 text-red-400 hover:bg-gray-600' }}"
        title="No Me Gusta">

        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM10 17.5a1 1 0 001-1V5.996a1 1 0 00-1-1H3.5A2.5 2.5 0 001 7.496v6.008A2.5 2.5 0 003.5 16.004H6.142a2 2 0 001.858 1.995L10 17.5z" />
        </svg>
        No Me Gusta ({{ $dislikesCount }})
    </button>
</div>
