<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


<div class="intro-y flex items-center mt-8">
        <!-- <h2 class="text-lg font-medium mr-auto">{{ Str::upper( env('APP_NAME') ) }}</h2> -->
        <h2 class="text-lg font-medium mr-auto">Organization Setup</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('settings.organization.components.side-menu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Company Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Organization Setup)</h2>
                </div>
                <div class="p-5">
                <form action="{{ route('org.setup') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-5" id="logo">

                        <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md object-contain" alt="{{ orgName() }}" src="{{ logo() }}">
                                    
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">@translate(Change Logo)</button>
                                    <input type="file" name="logo" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>

                         <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md object-contain" alt="{{ orgName() }}" src="{{ favIcon() }}">
                                    
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">@translate(Change Favicon)</button>
                                    <input type="file" name="favIcon" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>

                         <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md object-contain" alt="{{ orgName() }}" src="{{ footerLogo() }}">
                                    
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">@translate(Change Footer Logo)</button>
                                    <input type="file" name="footer_logo" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- END: Company Information -->


            <!-- BEGIN: Company Information -->
            <div class="intro-y box lg:mt-5" id="#contact">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Company Information)</h2>
                </div>
                <div class="p-5">

                        <div class="col-span-12 xl:col-span-8">
                            <div class="mt-3">
                                <label>@translate(Company Name) <small>@translate(required)</small> </label>
                                <input type="text" class="input w-full border bg-gray-100 mt-2" placeholder="@translate(Company Name)" value="{{ org('company_name') ?? null }}" name="company_name" data-parsley-required>
                            </div>
                            <div class="mt-3">
                                <label>@translate(Company Email) <small>@translate(required)</small> </label>
                                <input type="email" class="input w-full border bg-gray-100 mt-2" placeholder="@translate(Company Email)" name="company_email" value="{{ org('company_email') ?? null }}" data-parsley-type="email" data-parsley-required>
                            </div>
                            <div class="mt-3">
                                <label>@translate(Company Phone Number) <small>@translate(required)</small> </label>
                                <input type="number" class="input w-full border bg-gray-100 mt-2" placeholder="@translate(Company Phone Number)" name="company_phone_number" value="{{ org('company_phone_number') ?? null }}" data-parsley-required>
                            </div>
                        </div>
               
                </div>
            </div>
            <!-- END: Company Information -->


            <!-- BEGIN: Contact Information -->
            <div class="intro-y box lg:mt-5" id="#contact">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Contact Information)</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mt-3">
                                <label>@translate(Company Telephone Number) <small>@translate(optional)</small> </label>
                                <input type="text" name="company_tel_number" class="input w-full border mt-2" placeholder="@translate(Telephone Number)" value="{{ org('company_tel_number') ?? null }}" data-parsley-type="number">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mt-3">
                                <label>@translate(Company Address) <small>@translate(optional)</small> </label>
                                <input type="text" class="input w-full border mt-2" placeholder="@translate(Company Address)" name="company_address" value="{{ org('company_address') ?? null }}">
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
            <!-- END: Contact Information -->

            <!-- BEGIN: Social Information -->
            <div class="intro-y box lg:mt-5" id="#social">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Social Information)</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mt-3">
                                <label>@translate(facebook) <small>@translate(optional)</small> </label>
                                <input type="text" name="facebook" class="input w-full border mt-2" placeholder="@translate(Facebook Link)" value="{{ org('facebook') ?? null }}">
                            </div>
                            <div class="mt-3">
                                <label>@translate(Linkedin) <small>@translate(optional)</small> </label>
                                <input type="text" name="linkedin" class="input w-full border mt-2" placeholder="@translate(Linkedin Link)" value="{{ org('linkedin') ?? null }}">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mt-3">
                                <label>@translate(Skype) <small>@translate(optional)</small> </label>
                                <input type="text" class="input w-full border mt-2" name="skype" placeholder="@translate(Skype Number)" value="{{ org('skype') ?? null }}">
                            </div>
                            <div class="mt-3">
                                <label>@translate(Twitter) <small>@translate(optional)</small> </label>
                                <input type="text" class="input w-full border mt-2" name="twitter" placeholder="@translate(Twitter Link)" value="{{ org('twitter') ?? null }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Social Information -->

            <!-- BEGIN: Application Settings -->
            <div class="intro-y box lg:mt-5" id="#test">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Application Settings)</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div class="mt-3">
                                <label>@translate(Test Connection Email) <small>@translate(required)</small> <small>Ex: demo@maildoll.com</small> </label>
                                <input type="email" name="test_connection_email" class="input w-full border mt-2" placeholder="Test Connection Email" value="{{ org('test_connection_email') ?? null }}" data-parsley-type="email" data-parsley-required>
                            </div>
                            <div class="mt-3">
                                <label>@translate(Test Connection Sms Number) <small>@translate(required)</small> <small>Ex: +8801825731327</small> </label>
                                <input type="text" name="test_connection_sms" class="input w-full border mt-2" placeholder="Test Connection Sms Number" value="{{ org('test_connection_sms') ?? null }}" data-parsley-type="number" data-parsley-required>
                            </div>
                            <div class="mt-3">
                                <label>@translate(Color) <small>@translate(optional)</small> </label>
                                <input type="text" name="color" class="input w-full border mt-2" placeholder="#fffff" value="{{ org('color') ?? null }}">
                            </div>



                            <div class="mt-5">
                                <label>@translate(Choose layout) <small>Default is classic</small> </label>
                            </div>
                            {{-- Theme layouts --}}
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                
                                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="box">
                                            <div class="flex items-start px-5 pt-5">
                                                <div class="w-full flex flex-col lg:flex-row items-center">
                                                    <div class="section over-hide z-bigger">
                                                        <div class="section over-hide z-bigger">
                                                            <div class="container pb-5">
                                                                <div class="row justify-content-center pb-5">
                                                                    <div class="col-12 pb-5">
                                                                        <input class="checkbox-tools" type="radio" value="classic" {{ themeLayout() == 'classic' ? 'checked' : null }} name="layout" id="tool-1">
                                                                        <label class="for-checkbox-tools w-full" for="tool-1">
                                                                            <div class="">
                                                                                <div class="h-60 xxl:h-60 image-fit">
                                                                                    <div class="rounded-md preview-template">
                                                                                        <div 
                                                                                            style="background-image: url('{{ asset('layouts/classic.png') }}');" 
                                                                                            class="preview-template">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>



                                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="box">
                                            <div class="flex items-start px-5 pt-5">
                                                <div class="w-full flex flex-col lg:flex-row items-center">
                                                    <div class="section over-hide z-bigger">
                                                        <div class="section over-hide z-bigger">
                                                            <div class="container pb-5">
                                                                <div class="row justify-content-center pb-5">
                                                                    <div class="col-12 pb-5">
                                                                        <input class="checkbox-tools" type="radio" value="modern" {{ themeLayout() == 'modern' ? 'checked' : null }} name="layout" id="tool-2">
                                                                        <label class="for-checkbox-tools w-full" for="tool-2">
                                                                            <div class="">
                                                                                <div class="h-60 xxl:h-60">
                                                                                    <div class="rounded-md preview-template">
                                                                                        <div 
                                                                                            style="background-image: url('{{ asset('layouts/modern.png') }}');" 
                                                                                            class="preview-template">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            {{-- Theme layouts:END --}}


                            {{-- RTL --}}
                            <div class="mt-5">
                                <label>@translate(Choose Direction) <small>Default is LTR</small> </label>
                            </div>
                            {{-- Theme layouts --}}
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                
                                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="box">
                                            <div class="flex items-start px-5 pt-5">
                                                <div class="w-full flex flex-col lg:flex-row items-center">
                                                    <div class="section over-hide z-bigger">
                                                        <div class="section over-hide z-bigger">
                                                            <div class="container pb-5">
                                                                <div class="row justify-content-center pb-5">
                                                                    <div class="col-12 pb-5">
                                                                        <input class="checkbox-tools" type="radio" value="ltr" {{ themedirection() == 'ltr' ? 'checked' : null }} name="direction" id="tool-3">
                                                                        <label class="for-checkbox-tools w-full" for="tool-3">
                                                                            <div class="">
                                                                                <div class="h-60 xxl:h-60 image-fit">
                                                                                    <div class="rounded-md preview-template">
                                                                                        <div 
                                                                                            style="background-image: url('{{ asset('layouts/ltr.png') }}');" 
                                                                                            class="preview-template">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>



                                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="box">
                                            <div class="flex items-start px-5 pt-5">
                                                <div class="w-full flex flex-col lg:flex-row items-center">
                                                    <div class="section over-hide z-bigger">
                                                        <div class="section over-hide z-bigger">
                                                            <div class="container pb-5">
                                                                <div class="row justify-content-center pb-5">
                                                                    <div class="col-12 pb-5">
                                                                        <input class="checkbox-tools" type="radio" value="rtl" {{ themedirection() == 'rtl' ? 'checked' : null }} name="direction" id="tool-4">
                                                                        <label class="for-checkbox-tools w-full" for="tool-4">
                                                                            <div class="">
                                                                                <div class="h-60 xxl:h-60">
                                                                                    <div class="rounded-md preview-template">
                                                                                        <div 
                                                                                            style="background-image: url('{{ asset('layouts/rtl.png') }}');" 
                                                                                            class="preview-template">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            {{-- Theme layouts:END --}}

                            {{-- RTL::END --}}



                            {{-- THEME MANAGER --}}

                            <div class="mt-5">
                                <label>@translate(Select Theme) <small>Default is Argon</small> </label>
                            </div>

                            <div class="grid grid-cols-12 gap-6 mt-5">
                                
                                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="box">
                                        <div class="flex items-start px-5 pt-5">
                                            <div class="w-full flex flex-col lg:flex-row items-center">
                                                <div class="section over-hide z-bigger">
                                                    <div class="section over-hide z-bigger">
                                                        <div class="container pb-5">
                                                            <div class="row justify-content-center pb-5">
                                                                <div class="col-12 pb-5">
                                                                    <input class="checkbox-tools" type="radio" value="neon" {{ theme() == 'neon' ? 'checked' : null }} name="theme" id="neon">
                                                                    <label class="for-checkbox-tools w-full" for="neon">
                                                                        <div class="">
                                                                            <div class="h-60 xxl:h-60 image-fit">
                                                                                <div class="rounded-md preview-template">
                                                                                    <div 
                                                                                        style="background-image: url('{{ asset('themes/neon.png') }}');" 
                                                                                        class="preview-template">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="box">
                                        <div class="flex items-start px-5 pt-5">
                                            <div class="w-full flex flex-col lg:flex-row items-center">
                                                <div class="section over-hide z-bigger">
                                                    <div class="section over-hide z-bigger">
                                                        <div class="container pb-5">
                                                            <div class="row justify-content-center pb-5">
                                                                <div class="col-12 pb-5">
                                                                    <input class="checkbox-tools" type="radio" value="argon" {{ theme() == 'argon' ? 'checked' : null }} name="theme" id="argon">
                                                                    <label class="for-checkbox-tools w-full" for="argon">
                                                                        <div class="">
                                                                            <div class="h-60 xxl:h-60 image-fit">
                                                                                <div class="rounded-md preview-template">
                                                                                    <div 
                                                                                        style="background-image: url('{{ asset('themes/argon.png') }}');" 
                                                                                        class="preview-template">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- THEME MANAGER::ENDS --}}



                            <div class="mt-3">
                                <label>@translate(Developer Options)</label>
                                <input type="checkbox" name="dev_mode" class="input w-full border mt-2" value="1" {{ org('dev_mode') == 1 ? 'checked' : '' }}>
                            </div>

                            <div class="mt-3">
                                <label>@translate(Disable Homepage)</label>
                                <input type="checkbox" name="disable_homepage" class="input w-full border mt-2" value="1" {{ env('DISABLE_THEME') == 'YES' ? 'checked' : '' }}>
                            </div>



                        </div>
                    </div>
                       <div class="flex justify-end mt-4">
                        <button type="submit" class="button w-20 bg-theme-1 text-white ml-auto">@translate(Save)</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- END: Application Settings -->


        </div>
    </div>

</div>

