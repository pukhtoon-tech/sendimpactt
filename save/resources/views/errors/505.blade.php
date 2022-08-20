@extends('../layout/side-menu')

@section('head')
    <title>@translate(505)</title>
@endsection

@section('content')
    <div class="container">
        <!-- BEGIN: Error Page -->
        <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
            <div class="-intro-x lg:mr-20">
                <img alt="#purchase-failed" class="" src="{{ asset('errors/505.png') }}">
            </div>
            <div class="text-white mt-10 lg:mt-0">
                <div class="intro-x text-6xl font-medium">@translate(Whoops)</div>
                <div class="intro-x text-xl lg:text-3xl font-medium">@translate(An unexpected error occurs.)</div>
                <div class="intro-x text-lg mt-3">@translate(Why not try refreshing your page? or you can contact us if the error persists.)</div>
                <br><br>
                <a href="{{ route('dashboard') }}" class="intro-x button button--lg border border-white dark:border-dark-5 dark:text-gray-300 mt-10">@translate(Back to Home)</a>
            </div>
        </div>
        <!-- END: Error Page -->
    </div>
@endsection