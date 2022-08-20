@extends('layout.login')

@section('head')
    <title>@translate(Email Verification)</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="xl:flex flex-col min-h-screen">
                <a href="{{ route('dashboard') }}" class="-intro-x flex items-center pt-5">
                    <img alt="Maildoll" class="w-6" src="{{ logo() }}">
                    <span class="text-white text-lg ml-3">
                        {{ orgName() }}
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Maildoll" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">@translate(One click to) <br> @translate(verify your account).</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">@translate(Verify Your Email Address)</h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                @translate(A verification code has been sent to your email address)
                            </div>
                        @endif

                    </div>

                    <div class="intro-x mt-8">
                        <p>
                            @translate(Before proceeding, please check your email for a verification code. If you did not receive the email refresh the page or) <a href="{{ route('email.verification.code') }}" class="text-theme-1 font-semibold">@translate(click here to get new activation code)</a>.
                        </p>
                        
                    </div>
                    
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <form class="d-inline" method="GET" action="{{ route('email.verification.code.match') }}">
                            @csrf
                            <input type="text" maxlength="6" class="opt-input intro-x input input--lg w-50 border border-gray-300 block mt-4 padding-left-0 padding-right-0" placeholder="......" name="activation_code">
                            <div class="text-center mt-2">
                                <button class="button button--lg w-6/12 xl:w-100 text-white bg-theme-1 xl:mr-3 align-top mt-4">@translate(Verify)</button>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>    
@endsection
