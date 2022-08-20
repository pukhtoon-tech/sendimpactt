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
                    <a class="flex items-center {{ request()->routeIs('seo.index') ? 'text-theme-1 dark:text-theme-10 font-medium' : '' }}" href="javascript:;">
                        <i data-feather="framer" class="w-4 h-4 mr-2"></i> @translate(Seo Setup)
                    </a>
                    
                    <br>
                    <p>@translate(A meta description sometimes called a meta description attribute or tag is an HTML element that describes and summarizes the contents of your page for the benefit of users and search engines.)</p>
                    <br>
                    <p>@translate(Meta Keywords are a specific type of meta tag that appear in the HTML code of a Web page and help tell search engines what the topic of the page is.)</p>
                    
                </div>
             
               
            </div>
        </div>