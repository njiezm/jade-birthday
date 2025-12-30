@props(['class', 'svg'])

<div class="floating-asset {{ $class }}">
    @if(file_exists(public_path('images/' . $svg)))
        <img src="{{ asset('images/' . $svg) }}" alt="Élément décoratif" class="img-fluid">
    @else
        <!-- Image de remplacement ou message d'erreur -->
        <div class="image-error">Image non trouvée: {{ $svg }}</div>
    @endif
</div>