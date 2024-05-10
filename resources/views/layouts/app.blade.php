<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @toastifyCss
    </head>
    <body class="font-sans antialiased">
        <div class="loader-wrapper" id="loaderWrapper">
            <div class="loader">
                <div data-glitch="Loading..." class="glitch">Loading...</div>
            </div>
        </div>
        @include('layouts.navigation')
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <!-- Page Heading -->
            {{--@if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif--}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    @stack('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready( function() {
                toastr.options = {
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
            });

            window.addEventListener('success', event => {
                toastr.success(event.detail[0].message);
            });
            window.addEventListener('warning', event => {
                toastr.warning(event.detail[0].message);
            });
            window.addEventListener('error', event => {
                toastr.error(event.detail[0].message);
            });
        </script>
        <script>
            const toggleSidebar = () => document.body.classList.toggle("open");
        </script>
    @toastifyJs
    </body>
</html>
