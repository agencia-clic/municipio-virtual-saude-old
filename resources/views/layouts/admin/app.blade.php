<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ (!empty($title)) ? $title: env('APP_NAME'); }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/admin/img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/admin/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/admin/img/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/admin/img/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('/admin/img/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/admin/img/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <script src="{{ asset('admin/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>
    <link href="{{ asset('admin/vendors/choices/choices.min.css') }}" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('admin/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('admin/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('admin/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('admin/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" id="user-style-default">

    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
        }
    </script>

    <!-- Head -->
    @yield('head')
    @section('head')
    @stop
</head>

<body data-id="{{ auth()->user()->units_current()->IdServiceUnits ?? "" }}" token="{{ auth()->user()->api_token ?? "" }}" IdUsers="{{ auth()->user()->IdUsers }}">
    
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>

            <!-- header -->
            @if(empty($layout['header']))
                @include('layouts/admin/fragments.header')
            @endif

            <!-- Content -->
            <div class="content">

                @yield('content')
                @section('content')
                @stop
            </div>

        </div>
    </main>

    @if(empty($layout['header']))
        @include('layouts/admin/fragments.customize')
    @endif

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('admin/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('admin/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('admin/js/theme.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('admin/js/modal.js') }}"></script>
    <script src="{{ asset('admin/js/request.js') }}"></script>
    <script src="{{ asset('admin/js/delete.js') }}"></script>
    <script src="{{ asset('admin/js/units-change.js') }}"></script>
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/vendors/choices/choices.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script>
        $(document).ready(function() {
            @if($close = Session::get('modal_close'))
                window.parent.close_modal('{{ $close }}');
            @endif

            @if($message = json_decode(Session::get('modal'), true))
                modal_info("SUCESSO", '', '{{$message['description']}}', '{{$message['color']}}', "<?=$message['button'] ?? ""?>")
            @endif

            @if($open = Session::get('open-tab'))
                new_tab('<?=$open?>')
            @endif
        })
    </script>

    <!-- Scripts -->
    @yield('scripts')
    @section('scripts')
    @stop

</body>

</html>