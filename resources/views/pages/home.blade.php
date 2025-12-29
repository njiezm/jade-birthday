@extends('layouts.app')

@section('content')

<x-hero />

<section class="max-w-5xl mx-auto px-6 mt-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <x-ticket-card
            title="Entrée Soirée"
            price="25"
            image="/images/bellini.png"
        />

        <x-ticket-card
            title="Entrée + Cocktail"
            price="35"
            image="/images/martini.png"
        />

        <x-ticket-card
            title="VIP Smirnoff"
            price="50"
            image="/images/smirnoff.png"
        />

    </div>
</section>

<section class="mt-24 text-center">
    <a href="{{ route('paiement') }}"
       class="inline-block px-10 py-5 bg-pink-400 text-white uppercase tracking-widest rounded-2xl shadow-lg hover:scale-105 transition">
        Réserver ma place
    </a>
</section>

@endsection
