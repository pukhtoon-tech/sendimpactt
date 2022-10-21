<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

<div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ Str::upper(username()) }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('testing_url.components.profile_sidemenu')    
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Display Information)</h2>
                </div>
                <div class="p-5">

                <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-4 hidden">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-default mx-auto">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{ avatar() }});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">@translate(Change Photo)</button>
                                    <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" name="avatar" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-12">
                            <div>
                                <label>@translate(Display Name) <small>@translate(required)</small> </label>
                                <input type="text" class="input w-full border bg-gray-100 mt-2" placeholder="Enter Name" value="{{ userInfo()->name }}" name="name" data-parsley-required>
                            </div>
                          
                            <div class="mt-3">
                                <label>@translate(Display Email)</label>
                                <input type="email" name="email" class="input w-full border bg-gray-100 mt-2" value="{{ userInfo()->email }}">
                            </div>
                            
                            <button type="submit" class="button w-50 bg-theme-1 text-white mt-3">@translate(Update Display Information)</button>
                        </div>
                    </div>

                </form>

                </div>
            </div>
            <!-- END: Display Information -->
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Personal Information)</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <form action="{{ route('user.personal.update') }}" method="post">
                                @csrf
                       
                            <div class="">
                                <label>@translate(NID Number) <small>@translate(optional)</small></label>
                                <input type="text" name="nid" class="input w-full border mt-2" placeholder="Input NID" value="{{ userInfo()->personal->nid ?? null }}">
                            </div>
                       
                            <div class="mt-4">
                                <label>@translate(IP Address)</label>
                                <input type="text" class="input w-full border mt-2 cursor-not-allowed" disabled value="{{ userInfo()->visitor ?? null }}">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div>
                                <label>@translate(Phone Number) <small>@translate(optional)</small></label>
                                <input type="number" data-parsley-type="number" minlength="6" name="phone" class="input w-full border mt-2" placeholder="Input Phone Number" value="{{ userInfo()->personal->phone ?? null }}">
                            </div>
                            <div class="mt-4">
                                <label>@translate(Address) <small>@translate(optional)</small></label>
                                <input type="text" name="address" class="input w-full border mt-2" placeholder="Input Address" value="{{ userInfo()->personal->address ?? null }}">
                            </div>
                            
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="button w-50 bg-theme-1 text-white ml-auto">@translate(Update Personal Information)</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- END: Personal Information -->
        </div>
    </div>

</div>
