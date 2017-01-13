<!DOCTYPE html>
<html lang="ja">
<head>
    @include('layouts/html_head')
    @yield('css')

    <!-- ====== Common ====== -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="/dist/css/custom.css">
</head>
<body>
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layouts/header')
        @include('layouts/sidebar-left')
        <div class="content-wrapper">
            @include('layouts/breadcrumb')
            <section class="content">
            @yield('content')
            </section>
        </div>
        @include('layouts/footer')

        <!-- Modal load -->
        <div id="x-modal-overlay">
            <div class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>
</div>

@include('layouts/scripts')
@yield('javascript')
</body>
</html>