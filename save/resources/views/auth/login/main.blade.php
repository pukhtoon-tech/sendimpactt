@extends('../layout/login')

@section('head')
    <title>Login - {{ orgName() }}</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="flex-col min-h-screen hidden sm:hidden md:flex lg:flex xl:flex">
                <a href="{{ route('frontend.index') }}" class="-intro-x flex items-center pt-5 w-48">
                    <img alt="{{ orgName() }}" src="{{ logo() }}">
                    
                </a>
                <div class="my-auto">
                    <img alt="{{ orgName() }}" class="-intro-x w-1/2 -mt-16" src="{{ getImageForAuth('login') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">@translate(A few more clicks to) <br> @translate(sign in to your account.)</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto ml-3 mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    
                    
                     @if (env('DEMO_MODE') == "YES")

                    <div class="mt-5 m-auto xl:mt-8 text-center">
                     <button class="button button--lg w-1/4 text-white bg-theme-1 xl:mr-3 align-top tooltip" title="Login as admin" onclick="admin()"> Admin </button> 
                     <button class="button button--lg w-2/4 text-white bg-theme-1 xl:mr-3 align-top tooltip" title="Login as customer" onclick="customer()"> Customer </button>
                         <table class="table mt-4 w-full m-auto">
                             <thead> 
                                 <tr> 
                                     <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Email</th> 
                                     <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Password</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                <tr class="hover:bg-gray-200"> 
                                    <td class="border">admin@mail.com</td> 
                                    <td class="border">12345678</td> 
                                </tr> 
                                <tr class="hover:bg-gray-200"> 
                                    <td class="border">customer@mail.com</td> 
                                    <td class="border">12345678</td> 
                                </tr> 
                            </tbody> 
                        </table> 
                    </div> 
                        
                    @endif

                    <a href="{{ route('frontend.index') }}" class="-intro-x md:invisible flex items-center pt-5 w-48 m-auto mb-5">
                        <img alt="{{ orgName() }}" src="{{ logo() }}">
                    </a>
                    
                    
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">@translate(Sign In)</h2>


                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">@translate(A few more clicks to sign in to your account.)</div>
                    <div class="intro-x mt-8">
                        <form id="login-form">
                            <input type="email" id="input-email" class="intro-x login__input input w-full input--lg border border-gray-300 " placeholder="Enter Email" value="" data-parsley-type="email" data-parsley-required>
                            <div id="error-email" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                            <input type="password" id="input-password" class="intro-x login__input input w-full input--lg border border-gray-300 block mt-4" placeholder="Enter Password" value="" data-parsley-required>
                            <div id="error-password" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                        </form>
                    </div>
                    <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input type="checkbox" name="remember" class="input border mr-2" id="input-remember-me">
                            <label class="cursor-pointer select-none" for="input-remember-me">@translate(Remember me)</label>
                        </div>
                        <a href="{{ route('password.request') }}">@translate(Forgot Password)?</a>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn-login" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">@translate(Login)</button>
                        <button type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0 align-top" id="btn-signup">@translate(Sign up)</button>
                    </div>

                    
                    
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>


    <input type="hidden" value="{{ route('register') }}" id="signup_url">
    <input type="hidden" value="{{ route('dashboard') }}" id="dashboard_url">

@endsection

@section('script')
    <script src="{{ filePath('assets/js/auth.js') }}"></script>
    <script src="{{ filePath('assets/js/jquery.js') }}"></script>
    <script src="{{ filePath('assets/js/parsley.js') }}"></script>
    <script src="{{ filePath('assets/js/validation.js') }}"></script>
    
    @if (env('DEMO_MODE') == "YES")
    <script src="{{ filePath('bladejs/demo.js') }}"></script>
    @endif



@endsection
