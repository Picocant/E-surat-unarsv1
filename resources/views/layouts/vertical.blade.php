<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('vertical/assets/css/main/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
    @yield('style')
</head>

<body>
    <div id="app">
        @auth
        @include('layouts.partials.vertical.sidebar')
        @else
        @include('layouts.partials.vertical.guest-sidebar')
        @endauth
        <div id="main" class='layout-navbar'>
            @include('layouts.partials.vertical.header')
            <div id="main-content" style="padding-top: 0!important;">
                @yield('app')
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @livewireScripts
    <script src="{{ asset('vertical/assets/js/vertical.js') }}"></script>
    <script src="{{ asset('vertical/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                ordering: false
            });
        });
    </script>
    {{-- @include('layouts.partials.toasts') --}}
    <link rel="stylesheet" href="@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('layouts.partials.swals')
    @yield('script')
    <script>
        const sidebarLinks = document.querySelectorAll('.sidebar-menu a.sidebar-link')
        const path = window.location.pathname.split('/').filter((p, i) => i < 2).join('/')
        sidebarLinks.forEach(sidebarLink => {
            const sidebarLinkUrl = new URL(sidebarLink.href)
            const sidebarLinkParent = sidebarLink.parentElement
            if (sidebarLinkParent.classList.contains('has-sub') == false) {
                if (path == sidebarLinkUrl.pathname) {
                    sidebarLinkParent.classList.add('active')
                }
            } else {
                const submenuLinks = sidebarLinkParent.querySelectorAll('li.submenu-item a.submenu-link')
                submenuLinks.forEach(submenuLink => {
                    const submenuLinkUrl = new URL(submenuLink.href)
                    const submenuLinkParent = submenuLink.parentElement
                    if (path == submenuLinkUrl.pathname) {
                        submenuLinkParent.classList.add('active')
                        submenuLinkParent.parentElement.classList.add('active')
                        sidebarLinkParent.classList.add('active')
                    }
                })
            }
        })

        const resetFilterBtn = document.getElementById("reset-filter-btn")
        if (resetFilterBtn) {
            const form = resetFilterBtn.parentElement.parentElement
            const hiddenInputs = form.querySelectorAll("[type=hidden]")
            resetFilterBtn.addEventListener("click", (evt) => {
                form.reset()
                hiddenInputs.forEach(input => {
                    input.value = ''
                })
            })
        }
    </script>
</body>

</html>