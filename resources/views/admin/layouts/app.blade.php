<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>eCommerce Dashboard | Hash - Multipurpose Tailwind CSS & Bootstrap Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Hash is a modern, responsive admin dashboard available on ThemeForest. Ideal for building CRM, CMS, project management tools, and custom web applications with a clean UI, flexible layouts, and rich features." />
    <meta name="keywords"
        content="Hash, admin dashboard, ThemeForest, Bootstrap 5 admin, responsive admin, CRM dashboard, CMS admin, web app UI, admin theme, premium admin template" />
    <meta name="author" content="Hassh" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />


    <!-- Vector Maps css -->
    <link href="{{ asset('assets/plugins/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendors.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link id="app-style" href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- Per-page Styles -->
    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    {{-- Top Navigation --}}
    @include('admin.layouts.top-navigation', ['title' => $title ?? 'Dashboard'])


    <!-- Main wrapper -->
    <div class="content-page">
        @yield('content')



        {{-- Footer --}}
        @include('admin.layouts.footer')
    </div>

    <!-- Toaster -->
    @include('admin.layouts.toaster')


    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>


    <!-- Apex Chart js -->
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector Map Js -->
    <script src="{{ asset('assets/plugins/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/maps/world.js') }}"></script>

    <!-- Custom table -->
    <script src="{{ asset('assets/js/pages/custom-table.js') }}"></script>

    <!-- Dashboard js -->
    <script src="{{ asset('assets/js/pages/dashboard-ecommerce.js') }}"></script>

    <!-- Per-page Scripts -->
    @stack('scripts')

</body>

</html>
