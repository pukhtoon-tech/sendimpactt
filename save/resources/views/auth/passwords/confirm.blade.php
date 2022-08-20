@extends('layout.login')
@section('head')
    <title>@translate(Confirm Verification)</title>
@endsection
@section('content')


<div class="container sm:px-10">
        <div class="xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="{{ orgName() }}" class="w-6" src="{{ logo() }}">
                    <span class="text-white text-lg ml-3">
                        <span class="font-medium">{{ orgName() }}</span>
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="{{ orgName() }}" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign in to your account.</div>
                    <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">@translate(Verify Yourself by Password)</h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">

                    </div>

                    <div class="intro-x mt-8">
                        <p>
                            @translate(Enter your password to get access)
                        </p>
                        
                    </div>
                    
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <form class="d-inline" method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <input type="password" class="intro-x input input--lg w-full letter-spacing border border-gray-300 block mt-4" placeholder="******" name="password">
                            <button class="button button--lg w-full xl:w-100 text-white bg-theme-1 xl:mr-3 align-top mt-4">@translate(Verify)</button>
                        </form>
                    </div>
                   
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div> 
@endsection
