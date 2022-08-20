@extends('../layout/base')

@section('body')
    <body class="app rtl rtl-no-padding" onload="init();">
        @yield('content')

        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')

    <script src="{{ filePath('assets/js/default.js') }}"></script>
    <script src="{{ filePath('assets/js/sweetalert2@10.js') }}"></script>

</body>
@endsection