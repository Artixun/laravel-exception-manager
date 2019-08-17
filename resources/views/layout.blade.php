<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Exception Manager</title>

    <!-- Style sheets-->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset(mix('app.css', 'vendor/laravel-exception-manager')) }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="exception" v-cloak>
    <div class="container mb-5">
        <div class="d-flex align-items-center py-4 header">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path class="btn-primary" d="M15.3 14.89l2.77 2.77a1 1 0 0 1 0 1.41 1 1 0 0 1-1.41 0l-2.59-2.58A5.99 5.99 0 0 1 11 18V9.04a1 1 0 0 0-2 0V18a5.98 5.98 0 0 1-3.07-1.51l-2.59 2.58a1 1 0 0 1-1.41 0 1 1 0 0 1 0-1.41l2.77-2.77A5.95 5.95 0 0 1 4.07 13H1a1 1 0 1 1 0-2h3V8.41L.93 5.34a1 1 0 0 1 0-1.41 1 1 0 0 1 1.41 0l2.1 2.1h11.12l2.1-2.1a1 1 0 0 1 1.41 0 1 1 0 0 1 0 1.41L16 8.41V11h3a1 1 0 1 1 0 2h-3.07c-.1.67-.32 1.31-.63 1.89zM15 5H5a5 5 0 1 1 10 0z"></path>
            </svg>

            <h4 class="mb-0 ml-3"><strong>Laravel</strong> Exception Manager</h4>
        </div>

        <div class="row mt-4">

            <div class="col-12">
                <router-view></router-view>
            </div>

        </div>
    </div>
</div>

<!-- Global Telescope Object -->
<script>
    window.LaravelExceptionManager = @json($exceptionScriptVariables);
</script>

<script src="{{ asset(mix('app.js', 'vendor/laravel-exception-manager')) }}"></script>
</body>
</html>
