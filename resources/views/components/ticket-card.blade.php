@props(['title', 'price', 'image'])

<div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:scale-105 transition">
    <img src="{{ $image }}" class="h-56 w-full object-cover">

    <div class="p-6 text-center">
        <h3 class="text-lg uppercase tracking-widest">
            {{ $title }}
        </h3>

        <p class="mt-4 text-3xl font-light text-pink-500">
            {{ $price }}€
        </p>
    </div>
</div>
