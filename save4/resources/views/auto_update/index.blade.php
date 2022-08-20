@extends('install.app')

@section('content')

    <div class="drawer drawer-mobile"><input id="main-menu" type="checkbox" class="drawer-toggle">
        <main class="flex-grow block overflow-x-hidden bg-base-100 text-base-content drawer-content content-center">

            <div class="p-4 lg:p-10">

                <div class="grid grid-cols-1 gap-4 lg:p-10 lg:grid-cols-2 xl:grid-cols-3 lg:bg-base-200 rounded-box">

                    <div class="card row-span-3 shadow-lg compact bg-base-100 hidden md:block bg-white">
                        <figure><img src="{{ asset('install/img/capoo-bugcat.gif') }}" style="height: 580px;"></figure>
                    </div>


                    <div class="card col-span-1 row-span-3 shadow-lg xl:col-span-2 bg-base-100">
                        <div class="card-body">
                            <h2 class="text-4xl font-bold card-title">
                                <a href="{{ route('frontend.index') }}">
                                    {{__('Maildoll - Email & SMS Marketing SaaS Application')}} 
                                </a>
                                
                                <small>v{{ env('VERSION') }}</small> </h2>

                            <div class="hero h-full bg-base-200 rounded-box">
                                <div class="text-center hero-content">
                                    <div class="max-w-md">

                                    @if($message = Session::get('message'))
                                        <h3 class="px-4 py-4 font-medium leading-4">{{ $message }}</h3>
                                    @endif
                                         
                                    <a href="{{ route('auto.update.fire') }}" class="btn btn-outline">{{ __('Click-to-Upgrade') }}</a>
                                    
                            <div class="-m-2 mt-5">
                                <div class="p-2">
                                    <div class="bg-white text-black rounded p-2 shadow text-md">
                                    <span class="px-2 font-medium leading-4">
                                        {{__('Before application update please make sure you have backed up your database and files.
                                        Upgrade may take time to finish. Do not close this window or disconnect your internet connection.')}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                                    
                            </div>
                                    
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </main>
    </div>

@endsection