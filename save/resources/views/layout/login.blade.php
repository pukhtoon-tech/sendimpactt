@extends('../layout/base')

@section('body')
    <body class="login">
        @yield('content')

        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection