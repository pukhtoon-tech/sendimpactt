@extends('../layout/' . layout())

@section('subhead')
    <title>{{ username() }} - Change Password - </title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">@translate(Change Password)</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('profile.components.profile_sidemenu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Change Password)</h2>
                </div>
                <div class="p-5">
                    <form action="{{ route('profile.password.changed') }}" method="post">
                        @csrf
                  
                    <div class="mt-3">
                        <label>@translate(New Password)  <small>@translate(required)</small></label>
                        <input type="password" required name="new_password" class="input w-full border mt-2 @error('new_password') border-theme-6 @enderror" placeholder="New Password">

                        @error('new_password')
                            <span class="text-theme-6" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                  
                    <button type="submit" class="button bg-theme-1 text-white mt-4">@translate(Change Password)</button>
                    </form>
                </div>
            </div>
            <!-- END: Change Password -->
        </div>
    </div>
@endsection