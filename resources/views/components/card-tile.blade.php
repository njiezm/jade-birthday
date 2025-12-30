@props(['title', 'description', 'icon', 'link'])

<div class="col-6 col-md-4">
    <a href="{{ $link }}" class="card-wedding">
        <i class="fa-solid {{ $icon }} icon-main-tile"></i>
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-description">{{ $description }}</p>
        <span class="access-link">Accéder <i class="fa-solid fa-chevron-right ms-1"></i></span>
    </a>
</div>
