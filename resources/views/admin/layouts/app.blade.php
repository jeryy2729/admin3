<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')

    <script>
        if (window.performance && window.performance.navigation.type === 2) {
            location.reload(true); // Reload on back navigation
        }
    </script>
</head>
<body>
    <div id="app">
        {{-- Top Navbar --}}
        @include('admin.layouts.includes.navbar')

        {{-- Page Content Area --}}
        <div class="container-fluid">
            <div class="row min-vh-100">
                
                {{-- Sidebar (Left Column) --}}
                <div class="col-md-3 col-sm-4 bg-light p-4 shadow-sm" style="border-right: 1px solid #dee2e6;">
                    @include('admin.layouts.includes.sidebar')
                </div>

                {{-- Main Dashboard Content (Right Column) --}}
                <div class="col-md-9 col-sm-8 p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
