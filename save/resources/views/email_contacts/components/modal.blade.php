<div class="modal" id="superlarge-modal-size-preview">
     <div class="modal__content modal__content--xl p-10"> 
        <div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">@translate(Add New Contact)</h2>
</div>
<div class="grid grid-cols-12 gap-12 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->

        <form class="" id="contactsForm" 
        enctype="multipart/form-data"
        action="{{ route('email.contact.store') }}"
        onsubmit="return validateform()"
        name="myform" 
        method="POST">
        @csrf

            <div class="mt-3">
            <div class="input-form"> 
                <label class="flex flex-col sm:flex-row"> @translate(Name)*</label> 
                <input type="text" name="name" class="input w-full border mt-2" placeholder="Ex: John Doe">
                <small>@translate(Empty username field will make name from email.)</small>
            </div>
            </div>

            <div class="mt-6">
            <div class="input-form"> 
                <label class="flex flex-col sm:flex-row"> @translate(Email)</label> 
                <input type="email" name="email" class="input w-full border mt-2" id="email" placeholder="Ex: jhondoe@mail.com" data-parsley-type="email">
                <small>@translate(Empty email field will not count as an email contact.)</small>
                 </div>
            </div>

            <div class="mt-6">
            <div class="input-form mt-2">
                
                
                <label class="flex flex-col sm:flex-row"> @translate(User Phone)</label> 

                <div class="flex">

                    <div class="w-2/5">

                        <select data-search="false" class="form-select w-full" name="country_code">

                            @forelse (country_codes() as $country_code)
                                <option data-countryCode="{{ $country_code->iso3 }}" value="{{ $country_code->phonecode }}">{{ $country_code->nicename }} (+{{ $country_code->phonecode }})</option>
                            @empty
                                <option data-countryCode="dasdDZ" value="2dasfdfddas13">No country found</option>
                            @endforelse
                            
                        </select>

                    </div>

                    

                <input type="number" name="phone" class="input w-full border" placeholder="Ex: 1825731327">
                    
                </div>

                
                    <small>@translate(Empty phone field will not count as a sms contact.)</small>
                 </div>
            </div>
   
       <button type="submit"
                class="button bg-theme-1 text-white mt-5">@translate(Save)</button>
        </form>
        <!-- END: Form Layout -->
   
</div>
</div>
     </div>
 </div>

<script src="{{ filePath('bladejs/email_contacts/components/modal.js') }}"></script>
