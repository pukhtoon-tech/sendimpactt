@extends('../layout/login')

@section('head')
    <title>@translate(Register) - {{ orgName() }}</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="xl:flex flex-col min-h-screen">
                <a href="{{ route('dashboard') }}" class="-intro-x flex items-center pt-5">
                    <img alt="{{ orgName() }}" class="w-6" src="{{ logo() }}">
                    <span class="text-white text-lg ml-3">
                        <span class="font-medium">{{ orgName() }}</span>
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Maildoll" class="-intro-x w-1/2 -mt-16" src="{{ getImageForAuth('register') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">@translate(A few more clicks to) <br> @translate(to create your account).</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">

                    <form action="{{ route('user_register') }}" method="post">
                        @csrf

                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">@translate(Sign Up)</h2>
                    <div class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center">@translate(A few more clicks to create your account.)</div>
                    <div class="intro-x mt-8">
                        <input type="text" name="name" class="intro-x login__input input input--lg border border-gray-300 block w-full" placeholder="Full Name">
                        <input type="email" name="email" class="intro-x login__input input input--lg border border-gray-300 block mt-4 w-full" placeholder="Email">
                        <input type="password" id="pwd" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4 w-full" placeholder="Password">
                      <div class="intro-x text-gray-600 block mt-4 text-xs sm:text-sm mt-2">
                          <p class="" id="strength_message"></p>
                      </div>
                      
                      <input type="password" id="cpwd" name="password_confirmation" class="intro-x login__input input input--lg border border-gray-300 block mt-4 w-full" placeholder="Password Confirmation">
                          <div class="intro-x text-gray-600 block mt-4 text-xs sm:text-sm mt-2">
                              <p class="" id="match_msg"></p>
                          </div>
                    
                    </div>
                    
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">@translate(Register)</button>
                        <button type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0 align-top" id="btn-signin">@translate(Sign in)</button>
                    </div>

                    </form>

                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>    


<input type="hidden" value="{{ route('login') }}" id="login_url">

@endsection

@section('script')
<script src="{{ filePath('assets/js/auth.js') }}"></script>
@endsection