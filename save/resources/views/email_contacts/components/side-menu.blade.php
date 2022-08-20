<div class="col-span-12 lg:col-span-3 xxl:col-span-2">
            <h2 class="intro-y text-lg font-medium mr-auto mt-2">@translate(Contacts)</h2>
            <!-- BEGIN: Inbox Menu -->
            <div class="intro-y box bg-theme-1 p-5 mt-6">
                <a href="javascript:;" data-toggle="modal" 
                data-target="#superlarge-modal-size-preview" class="button button--lg flex items-center justify-center text-gray-700 dark:text-gray-300 w-full bg-white dark:bg-theme-1 mt-2">
                    <i class="w-4 h-4 mr-2" data-feather="edit-3"></i> @translate(Add New Contact)
            </a>


             
                <div class="border-t border-theme-3 dark:border-dark-5 mt-6 pt-6 text-white">
                    <a href="javascript:void(0)" onclick="getEmails()" class="activeEmail flex items-center px-3 py-2 rounded-md dark:bg-dark-1 font-medium">
                        <i class="w-4 h-4 mr-2" data-feather="mail"></i> @translate(All Contacts)
                    </a>
                    <a href="javascript:void(0)" onclick="getFavourites()" class="activeFavourites flex items-center px-3 py-2 mt-2 rounded-md">
                        <i class="w-4 h-4 mr-2" data-feather="star"></i> @translate(Favourites)
                    </a>
                    <a href="javascript:void(0)" onclick="getBlocked()" class="activeBlocked flex items-center px-3 py-2 mt-2 rounded-md">
                        <i class="w-4 h-4 mr-2" data-feather="x-octagon"></i> @translate(Blocked)
                    </a>
                    <a href="javascript:void(0)" onclick="getTrashed()" class="activeTrashed flex items-center px-3 py-2 mt-2 rounded-md">
                        <i class="w-4 h-4 mr-2" data-feather="trash"></i> @translate(Trashed)
                    </a>
                </div>
                <div class="hidden border-t border-theme-3 dark:border-dark-5 mt-5 pt-5 text-white">
                    <a href="" class="flex items-center px-3 py-2 truncate">
                        <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div> ManyvendorCMS
                    </a>
                    <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md truncate">
                        <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div> CourseLMS
                    </a>
                    <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md truncate">
                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div> SamuraiPOS
                    </a>
                </div>
            </div>
            <!-- END: Inbox Menu -->
        </div>


 