@extends('layout.login')

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
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">@translate(Please enter your password) <br> @translate(what was sent to your email).</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">@translate(Recover Password)</h2>

                    <div class="intro-x mt-8">

                         @if($errors->any())
                         <div class="rounded-md flex items-center px-5 py-4 mt-2 mb-2 bg-theme-31 text-theme-6"> 
                             <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
                             {{$errors->first()}}
                        </div>
                        @endif

                        <h2 class="font-medium">
                            @translate(A new password has been generated and sent to your email address. Please check your email.)
                        </h2>

                       

                    </div>
                    
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <form class="d-inline" method="POST" action="{{ route('send.new.password') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="email" required class="intro-x input input--lg w-full border border-gray-300 block mt-4" placeholder="@translate(Enter your email address)" name="email">
                            <button type="submit" class="button button--lg w-full xl:w-100 text-white bg-theme-1 xl:mr-3 align-top mt-4">@translate(Send New Password To Email)</button>
                        </form>
                    </div>
                   
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div> 
@endsection
