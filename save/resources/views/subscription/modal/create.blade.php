<div class="modal" id="superlarge-subscription-modal-size-preview">
     <div class="modal__content modal__content--xl p-10"> 


        <div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">@translate(Add Subscription Plan & Limit)</h2>
</div>
<div class="grid grid-cols-12 gap-12 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->

        <form class="" 
        enctype="multipart/form-data"
        action="{{ route('subscription.store') }}"
        method="POST">
        @csrf

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Name) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: @translate(Free)</span>
                </label>
                
                <select data-placeholder="Select your favorite actors" name="name" data-search="true" class="tail-select w-full" single required> 
                     <option selected>Select Plan</option> 
                     <option value="free">Free</option> 
                     <option value="monthly">Monthly</option> 
                     <option value="yearly">Yearly</option> 
                </select>

            </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Description) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: This plan is all about free users</span>
                </label>
                
                  <textarea data-simple-toolbar="true" class="editor" name="description" required> </textarea> 

                 </div>
            </div>

            
            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Duration) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 2 months</span>
                </label> 
                
                <select data-placeholder="Select your favorite actors" name="duration" data-search="true" class="tail-select w-full" single required> 
                     <option selected>Select Month</option> 
                     <option value="1">1 Month</option> 
                     <option value="2">2 Months</option> 
                     <option value="3">3 Months</option>
                     <option value="4">4 Months</option> 
                     <option value="5">5 Months</option> 
                     <option value="6">6 Months</option> 
                     <option value="7">7 Months</option> 
                     <option value="8">8 Months</option> 
                     <option value="9">9 Months</option> 
                     <option value="10">10 Months</option> 
                     <option value="11">11 Months</option> 
                     <option value="12">12 Months</option> 
                </select> 

                 </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Limits  Of Email) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 1000</span>
                </label> <input type="number" name="emails" class="input w-full border mt-2" placeholder="Limits Of Email" required>
                 </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Limits Of SMS) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 1000</span>
                </label> <input type="number" name="sms" class="input w-full border mt-2" placeholder="Limits Of SMS" required>
                 </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Plan Price) <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: 100</span>
                </label> <input type="number" name="price" class="input w-full border mt-2" placeholder="Plan Price" required>
                 </div>
            </div>


            <div class="flex items-center text-gray-700 dark:text-gray-500 mt-5"> 
                <input type="checkbox" name="status" value="1" class="input border mr-2" checked id="vertical-remember-me"> 
                <label class="cursor-pointer select-none" for="vertical-remember-me">Publish Now</label>
            </div>

            <div class="flex items-center text-gray-700 dark:text-gray-500 mt-5"> 
                <input type="checkbox" name="display" value="1" class="input border mr-2" checked id="vertical-remember-me"> 
                <label class="cursor-pointer select-none" for="vertical-remember-me">Display at frontend</label>
            </div>


         
   
       <button type="submit"
                class="button bg-theme-1 text-white mt-5">@translate(Publish)</button>
        </form>
        <!-- END: Form Layout -->
   
</div>
</div>
     </div>
 </div>