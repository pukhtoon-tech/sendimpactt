@extends('install.app')

@section('css')

<style>

    .p-75px{
        padding: 75px 0;
    }
    
   .fancy-border-effect {
            width: 208px;
            height: 190px;
            margin: 60px auto;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }

        input[type="radio"]:checked+label.fancy-border-effect::before {
            opacity: 1;
            visibility: visible;
        }

        input[type="radio"]:checked+label.fancy-border-effect::after {
            opacity: 1;
            visibility: visible;
        }

        input {
            border: none;
        }

        label {
            border: none;
        }

        .text-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 666;
            transform: translate(-50%, -50%);
            color:
                white;
        }

        .fancy-border-effect::before {
            content: attr(content);
            position: absolute;
            width: 201px;
            height: 184px;
            z-index: 1;
            top: -47%;
            right: -46%;
            transform: translate(-50%, 50%);
            background-color: hsla(var(--b2)/var(--tw-bg-opacity,1));
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            -ms-border-radius: 50px;
            border-radius: 0;
            -o-border-radius: 50px;
            z-index: 22;
            transition: .3s;
            border-radius: 20px;
        }


        @keyframes border-animation {
            to {
                transform: rotate(360deg);
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
            }
        }

        .fancy-border-effect::after {

            content: "";
            width: 600px;
            height: 600px;
            position: absolute;
            top: -10%;
            right: -85%;
            right: -10% border-radius: 50px;
            background: conic-gradient(#3a7cec 0%12.5%,
                    #2ca24c 12.5%25%,
                    #f1b500 25%37.5%,
                    #e33e2b 37.5%50%,
                    #3a7cec 50%62.5%,
                    #2ca24c 62.5%75%,
                    #f1b500 75%87.5%,
                    #e33e2b 87.5%100%);
            animation: border-animation 5s linear infinite;
            -webkit-animation: border-animation 5s linear infinite;
            visibility: hidden;
            opacity: 0;
            transition: .3s;
        }

</style>
    
@endsection

@section('content')
    
  <div class="drawer drawer-mobile"><input id="main-menu" type="checkbox" class="drawer-toggle">
        <main class="flex-grow block overflow-x-hidden bg-base-100 text-base-content drawer-content">
         

        <div class="p-4 lg:p-10">
           
                <div class="grid grid-cols-1 gap-6 lg:p-10 xl:grid-cols-2 lg:bg-base-200 rounded-box">

                    <div class="card col-span-1 row-span-3 shadow-lg xl:col-span-2 bg-base-100">
                        <div class="card-body">
                            <h2 class="text-4xl font-bold card-title text-center">Maildoll - Email & SMS Marketing SaaS Application</h2>
                            <p class="my-4 font-bold  text-center">You need to choose the application mode between SaaS or Subscription</p>


                            <div class="alert">
                                <div class="flex-1">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#009688" class="flex-shrink-0 w-6 h-6 mx-4 mt-4">     
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>                     
                                    </svg> 

                                    <label>
                                        <p class="text-md text-base-content text-opacity-60">
                                           <strong>SAAS :</strong> For SaaS mode you need to purchase the Maildollsaas application from Codecanyon. Without the purchase you can't use the application. You must have cPanel for the SaaS mode. 
                                            The application use the cPanel API for the SaaS mode. Please choose carefully the application mode.
                                        </p>
                                     
                                    </label>
                                </div> 
                              
                            </div>


                            <div class="alert mt-2">
                                <div class="flex-1">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#009688" class="flex-shrink-0 w-6 h-6 mx-4 mt-1">     
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>                     
                                    </svg> 

                                    <label>
                                        <p class="text-md text-base-content text-opacity-60">
                                            <strong>Subscription :</strong> For Subscription mode you can use the application for your personal or subscription uses. Their is no cPanel API for the Subscription mode. Please choose carefully the application mode.
                                        </p>
                                    </label>
                                </div> 
                              
                            </div>



                            <div class="flex items-center justify-center w-screen mt-16">

                                <!-- Component Start -->
                                <form class="grid grid-cols-3 gap-2 w-full max-w-screen-sm" action="{{ route('saasorsubscription.setup') }}" method="GET">

                                    <input class="hidden" id="radio_1" type="radio" name="mode" value="YES">
                                    <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer border-width-0 p-75px fancy-border-effect"
                                        for="radio_1">
                                        <span class="text-xl font-bold mt-2 text-center text-icon">AUTOMATEMAIL SAAS</span>
                                    </label>

                                    <input class="hidden" id="radio_2" type="radio" name="mode" value="NO" checked>
                                    <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer border-width-0 p-75px fancy-border-effect"
                                        for="radio_2">
                                        <span class="text-xl font-bold mt-2 text-center text-icon">MAILDOLL SAAS</span>
                                    </label>
                                 
                                <!-- Component End  -->

                            </div>


                            <div class="justify-end space-x-2 card-actions">
                                <button type="submit" class="btn btn-primary">Save & Go To Installer</a>
                            </div>

                            </form>

                        </div>
                    </div>

                </div>
        </div>
    </main>
</div>

@endsection