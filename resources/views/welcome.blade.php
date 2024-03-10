<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="max-w-7xl mx-auto p-6 lg:p-8 grid justify-items-center">
    <x-application-logo></x-application-logo>
    <div x-data="imageSlider" class="relative mx-auto w-1/2 overflow-hidden rounded-md bg-gray-100">
        <button @click="previous()" class="absolute left-5 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-gray-100 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="font-bold text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </button>

        <button @click="forward()" class="absolute right-5 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-gray-100 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="font-bold text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>

        </button>

        <div class="relative h-80">
            <template x-for="(image, index) in images">
                <div x-show="currentIndex == index + 1" x-transition:enter="transition transform duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <img :src="image.link" alt="image" class="w-full mx-auto" />
                    <div x-text="image.quote" class="absolute bottom-0 left-0 w-full bg-black opacity-50 text-white p-4"></div>
                </div>
            </template>
        </div>
    </div>


    <a href="{{route('login')}}" class="m-5 w-1/2 rounded-3xl min-h-80 shadow-2xl shadow-g6 hover:shadow-g6-3 text-2xl font-bold flex items-center justify-center align-middle text-center">
            Se connecter et accéder à l'intranet.
    </a>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("imageSlider", () => ({
            currentIndex: 1,
            images: [
                {
                    link:"{{asset('img/direction/rudy.png')}}",
                    quote:"Coucou moi c'est Rudydy",
                },
                {
                    link:"{{asset('img/direction/johan.png')}}",
                    quote:"Coucou moi c'est Johan lanounouille",
                },
                {
                    link:"{{asset('img/direction/bill.png')}}",
                    quote:"Ecureuil ? Clébard !",
                },
                {
                    link:"{{asset('img/direction/dylan.png')}}",
                    quote:"Bande de singe ! Ouk-ouk rpz !",
                },
                {
                    link:"{{asset('img/direction/loona.png')}}",
                    quote:"Owiiiiiiiiiiiiii ! Y'aura ma langue en toi",
                },
            ],
            previous() {
                if (this.currentIndex > 1) {
                    this.currentIndex = this.currentIndex - 1;
                } else {
                    this.currentIndex = this.images.length;
                }
            },
            forward() {
                if (this.currentIndex < this.images.length) {
                    this.currentIndex = this.currentIndex + 1;
                } else {
                    this.currentIndex = 1;
                }
            },
        }));
    });
</script>
</div>
</body>
</html>
