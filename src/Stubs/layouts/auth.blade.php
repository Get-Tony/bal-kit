<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bal-kit bg-light">
    <div class="min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <!-- Brand Logo -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">{{ config('app.name', 'Laravel') }}</h2>
                        <p class="text-muted">{{ $subtitle ?? 'Welcome back' }}</p>
                    </div>

                    <!-- Auth Card -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            {{ $slot }}
                        </div>
                    </div>

                    <!-- Footer Links -->
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            Built with <span class="text-danger">&hearts;</span> using
                            <span class="text-primary fw-semibold">BAL Kit</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
