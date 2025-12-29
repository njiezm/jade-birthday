@props(['image', 'author'])

<div class="rounded-2xl overflow-hidden shadow-lg">
    <img src="{{ $image }}" class="w-full h-64 object-cover">
    @if($author)
        <div class="p-2 text-xs text-center text-gray-500">
            {{ $author }}
        </div>
    @endif
</div>
