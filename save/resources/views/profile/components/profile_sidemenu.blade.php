<div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Maildoll" class="rounded-full" src="{{ avatar() }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ username() }}</div>
                        <div class="text-gray-600">{{ userInfo()->user_type }}</div>
                    </div>
                 
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <p>@translate(Update display information and personal information. Please must give required field data for update profile. We will never share your personal information.)</p>
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    
                    <a class="flex items-center mt-5" href="{{ route('logout') }}">
                        <i data-feather="toggle-left" class="w-4 h-4 mr-2"></i> Logout
                    </a>
                </div>
               
            </div>
        </div>