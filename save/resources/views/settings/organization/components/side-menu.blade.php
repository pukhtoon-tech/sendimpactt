<div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    
                    <div class="w-12 h-12 image-fit">
                        <img alt="{{ org('company_name') ?? 'Maildoll' }}" class="rounded-full" src="{{ logo() }}">
                    </div>

                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ org('company_name') ?? 'Maildoll' }}</div>
                    </div>
                 
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="flex items-center {{ request()->routeIs('org.index') ? 'text-theme-1 dark:text-theme-10 font-medium' : '' }}" href="javascript:;">
                        <i data-feather="framer" class="w-4 h-4 mr-2"></i> @translate(Organization Setup)
                    </a>
                    <br>
                    <p>@translate(Please provide all required fields. These informations are visible for everyone. You should provide all valid informations.)</p>
                    <br>
                    <p>@translate(Test connection email and phone number must be a valid unless your system can not check email and sms configurations. )</p>
                    <br>
                    <p>@translate(Change dashboard primary color at anytime. You can choose Hexacode ) Ex: #fafafafa <br> @translate(or you can write solid color) Ex: green</p>
                    <br>
                    <p>@translate(If you fill nothing, system will choose deafult color.)</p>
                </div>
             
               
            </div>
        </div>