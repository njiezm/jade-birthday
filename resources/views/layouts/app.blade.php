<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jade Birthday – Martini Belini</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF7F5] text-[#2B2B2B]">

<header class="w-full py-6 px-6 flex justify-center">
    <h1 class="text-2xl tracking-wide font-light uppercase">
        Jade Birthday
        <span class="block text-sm tracking-widest text-pink-400">
            Martini · Bellini · Peach
        </span>
    </h1>
</header>

<main>
    @yield('content')
</main>

<footer class="mt-24 pb-10 text-center text-xs text-gray-400">
    © {{ date('Y') }} Jade Birthday
</footer>

</body>
</html>
