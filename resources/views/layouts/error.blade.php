<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('page.title') }}</title>
    <link rel="stylesheet" href="{{ asset('vertical/assets/css/main/app.css') }}">
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal pb-5">
            <div class="content-wrapper container">
                <div class="page-content py-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vertical/assets/js/app.js') }}"></script>
    @yield('script')
</body>

</html>
