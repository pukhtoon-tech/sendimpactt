            <button type="submit" class="button w-50 ml-8 mt-5 mr-2 mb-3 flex items-center justify-center bg-theme-1 text-white campaign-email"> 
                <i data-feather="activity" class="w-4 h-4 mr-2"></i> 
                    @translate(Save Campaign) 
            </button>
            
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

            {{-- Groups --}}
            <div class="grid grid-cols-12 gap-6 mt-5" id="groupsSection">
                @foreach (emailGroups('sms') as $group)
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
                    <div class="box">
                        <div class="flex items-start px-5 pt-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="">
                                    <img alt="#{{ $group->name }}" class="rounded-md" src="{{ commonAvatar($group->name) }}">
                                </div>

                                <div class="lg:ml-4 text-center lg:text-left mt-3 mb-3 lg:mt-0">
                                    <input type="checkbox" value="{{ $group->id }}" 
                                            id="{{ $group->id }}" 
                                            data-group-id="{{ $group->id }}" 
                                            class="input mt-3 group_id input--switch border" 
                                            name="group_id">
                                    <label for="{{ $group->id }}">
                                        {{ $group->name }}
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- Groups:END --}}

            <button type="submit" 
                    class="button w-50 ml-8 mt-5 mr-2 mb-3 flex items-center justify-center bg-theme-1 text-white campaign-email"> 
            <i data-feather="activity" class="w-4 h-4 mr-2"></i> 
                 @translate(Save Campaign) 
            </button>

<input type="hidden" value="{{ route('campaign.emails.store') }}" id="campaign_email_url">
<input type="hidden" value="{{ route('campaign.index') }}" id="campaign_list_url">

<input type="hidden" id="campaign_sms_url" value="{{ route('campaign.contacts.sms') }}">
<input type="hidden" id="campaign_email_fetch_data" value="{{ route('campaign.contacts.fetch_data') }}">

<script src="{{ filePath('assets/js/jquery.js') }}"></script>

<script src="{{ filePath('bladejs/campaigns/components/sms.js') }}"></script>