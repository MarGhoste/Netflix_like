@props(['href', 'title'])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-center justify-center group-hover:justify-start w-full space-x-4 p-2 rounded-lg text-gray-300 hover:text-white hover:bg-red-600/50 transition-all duration-300 group-hover:px-4',
        'title' => $title,
    ]) }}>
    @isset($icon)
        <div class="flex-shrink-0">
            {{ $icon }}
        </div>
    @endisset

    <span
        class="text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
        {{ $slot }}
    </span>
</a>
