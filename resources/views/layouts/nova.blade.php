<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">
</head>

<body class="min-w-site text-sm font-medium min-h-full text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900">
    <div class="py-6 px-1 md:px-2 lg:px-6">
        <div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8 max-w-[25rem] mx-auto">

                <h2 class="text-2xl text-center font-normal mb-6 text-90">@yield('title')</h2>

                <svg class="block mx-auto mb-6" xmlns="http://www.w3.org/2000/svg" width="100" height="2"
                     viewBox="0 0 100 2">
                    <path fill="#D8E3EC" d="M0 0h100v2H0z"></path>
                </svg>

                @yield('content')

            </div>
        </div>
    </div>

</body>
</html>
