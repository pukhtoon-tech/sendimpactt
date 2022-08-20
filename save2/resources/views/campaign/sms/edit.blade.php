@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Campaign) - {{ $edit_campaign->name }}</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">{{ Str::upper($edit_campaign->name) }}</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="wizard flex lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">1</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">@translate(Campaign Information)</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">2</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Choose Template)</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">3</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Update Audiance)</div>
            </div>
          
            <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('campaign.emails.update', $edit_campaign->id) }}" method="POST">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Campaign Name)</label>
                        <input type="text" class="input w-full border mt-2" name="name" id="campaign_name" value="{{ $edit_campaign->name }}" placeholder="Campaign Name">
                    </div>

                    <div class="input-form mt-3"> 
                        <label class="flex flex-col sm:flex-row"> @translate(Choose SMTP Server)*</label> 
                        <select class="w-full form-select sm:w-1/2" name="smtp_server_id" required id="smtp_server_id">
                            @forelse (getSmtpServerWiseList() as $provider => $email_provider)
                                <optgroup label="{{ Str::upper($provider) }} SERVER('s)">
                                    @forelse ($email_provider as $provider)
                                        <option value="{{ $provider->id }}" {{ $edit_campaign->smtp_server_id == $provider->id ? 'selected' : null }} class="normal-case">{{ Str::camel($provider->provider_name) }}</option>
                                    @empty
            
                                    @endforelse
                                </optgroup>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    
                    <div class="mt-3">
                        <label>@translate(Description)</label>
                        <div class="mt-2">
                            <textarea data-simple-toolbar="true" class="editor" name="description" id="description">
                                {{ $edit_campaign->description }}
                            </textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Active Status</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" id="status" class="input input--switch border" name="status" {{ $edit_campaign->status == 1 ? 'checked' : '' }}>
                        </div>
                    </div>


                     <div class="text-right mt-5">
                        <button type="submit" class="button w-40 bg-theme-1 text-white">@translate(Update Information)</button>
                    </div>


                    {{-- TEMPLATE --}}

                    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        @foreach (smsTemplates() as $templates)
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="box">
                                <div class="flex items-start px-5 pt-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">

                                        <div class="section over-hide z-bigger">
                                            <div class="section over-hide z-bigger">
                                                    <div class="container pb-5">
                                                        <div class="row justify-content-center pb-5">
                                                            <div class="col-12 pb-5">
                                                                <input class="checkbox-tools" type="radio" value="{{ $templates->id }}" name="sms_template_id" id="tool-{{ $templates->id }}" {{ $edit_campaign->sms_template_id ==  $templates->id ? 'checked' : '' }}>
                                                                <label class="for-checkbox-tools w-full" for="tool-{{ $templates->id }}">
                                                                    <div class="">
                                                                        <div class="h-80 xxl:h-56 image-fit">
                                                                            <div class="rounded-md w-1/2 m-auto preview-template ">
                                                                                <span class="text-lg font-medium leading-none">
                                                                                    {{  $templates->name }}
                                                                                </span>
                                                                                <hr>
                                                                                {{ strip_tags($templates->body) }}
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
                        @endforeach
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-40 bg-theme-1 text-white">@translate(Update Template)</button>
                    </div>
            <!-- END: Form Layout -->
        </div>

                    {{-- TEMPLATE::END --}}


                    {{-- AUDIANCE --}}
                    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
           

                {{-- EMAILS OR GROUPS --}}
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        <a href="#emailsSection" onclick="emailsList()" id="">
                            <div class="box shadow bg-theme-1 text-white">
                                <div class="flex items-start px-5 pt-5">
                                    <div class="w-full flex flex-col lg:flex-row items-center">

                                        
                                        <div class="lg:ml-4 text-center flex items-center lg:text-left mt-3 mb-3 lg:mt-0">
                                            <i data-feather="mail" class="mr-2"></i> @translate(CLICK TO GET NUMBERS)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                {{-- EMAILS OR GROUPS::END --}}
                

                    {{-- emails --}}
                    <div id="emails_list" class="hidden">
            
            <div id="emailsSection"></div>
            <!-- BEGIN: Inbox Content -->
            <div class="intro-y inbox box mt-5">
           
                <div class="loader_card animate-pulse col-span-12 lg:col-span-9 xxl:col-span-10 mt-5">
                    @for ($i = 1; $i < 21; $i++)
                    <div class="flex">
                        <div class="rounded-full mt-2 h-8 w-10 bg-gray-400"></div>
                        <div class="w-full mr-4 ml-4 h-8 mt-2 rounded-full bg-gray-400"></div>
                        <div class="w-20 h-8 mt-2 rounded-full bg-gray-400"></div>
                    </div>
                    @endfor
                </div>

                <div class="col-span-12 lg:col-span-9 xxl:col-span-10" id="campaignLoadPage"></div>

            </div>
            <!-- END: Inbox Content -->
                      
                    </div>
                    {{-- emails:END --}}

                </div>
           
            <!-- END: Form Layout -->
        </div>
                    {{-- AUDIANCE::END --}}
                   
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')

<input type="hidden" id="campaign_sms_edit_url" value="{{ route('campaign.contacts.sms.edit', $edit_campaign->id) }}">
<input type="hidden" id="campaign_email_fetch_data" value="{{ route('campaign.contacts.fetch_data.edit', $edit_campaign->id) }}">

<script src="{{ filePath('assets/js/jquery.js') }}"></script>

<script src="{{ filePath('bladejs/campaigns/sms/edit.js') }}"></script>
<script>
    $(document).ready(function(){
        localStorage.removeItem('idsArr');
        var a = null;
        // Parse the serialized data back into an aray of objects
        a = JSON.parse(localStorage.getItem('idsArr')) || [];
        // Push the new data (whether it be an object or anything else) onto the array
        a.push(
            <?php echo CampaignEmailArrayToString($edit_campaign->id) ?>
        );
        // Alert the array value
        // Re-serialize the array back into a string and store it in localStorage
        localStorage.setItem('idsArr', JSON.stringify(a));
});
</script>
@endsection