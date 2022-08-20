@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Campaigns)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Campaign List)</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            
            <a href="{{ route('campaign.create') }}" 
                class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" 
                title="@translate(Add new Campaign)">
                @translate(Add New Campaign)
            </a>
            
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="campaignIndex">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(ICON)</th>
                        <th class="whitespace-no-wrap">@translate(CAMPAING NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(EMAILS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(NUMBERS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(MAIL SERVER)</th>
                        <th class="text-center whitespace-no-wrap">@translate(TEMPLATE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody class="campaignName">
                    @forelse ($campaigns as $campaign)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="{{ $campaign->name  }}" class="tooltip rounded-full" src="{{ namevatar($campaign->name) }}" title="{{ $campaign->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" 
                                    class="font-medium whitespace-no-wrap tooltip flex" 
                                    title="{{ $campaign->name  }}">
                                    {{$campaign->name }}

                                    @if (checkCampaignExistsInAutoresponder($campaign->id))
                                        <i data-feather="share-2" class="ml-2 w-4"></i>
                                    @endif
                                </a>
                            </td>

                            <td class="text-center">{{ App\Models\CampaignEmail::where('campaign_id' , $campaign->id)->count() }}</td>
                            
                            <td class="text-center">{{ App\Models\CampaignEmail::where('campaign_id' , $campaign->id)->count() }}</td>


                            <td class="text-center normal-case">{{ Str::upper($campaign->relationWithSmtpServer->provider_name ?? 'No Server Found') }}</td>

                            <td class="text-center">
                                @if ($campaign->template_id != null)

                                <a href="{{ route('template.preview', $campaign->template->id) }}" target="_blank" class="text-theme-10 tooltip" title="@translate(Preview Template)">
                                    {{$campaign->template->title }}
                                </a>
                                    
                                @endif

                                @if ($campaign->sms_template_id != null)

                                <a href="{{ route('builder.sms.template.show', $campaign->smsTemplate->id) }}" target="_blank" class="text-theme-10 tooltip" title="@translate(Preview Template)">
                                    {{$campaign->smsTemplate->name }}
                                </a>
                                    
                                @endif
                                
                            </td>
                            
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $campaign->status == 1 ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $campaign->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            <td class="text-center w-40">{{ $campaign->created_at->diffForHumans() }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    
                                    <a class="flex items-center mr-3 tooltip" title="@translate(Edit)" href="{{ route('campaign.emails.edit', $campaign->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" 
                                    href="{{ route('campaign.emails.destroy', $campaign->id) }}" title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <td colspan="8">
                            <div class="text-center">
                                <img src="{{ notFound('campain-not-found.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $campaigns->firstItem() ?? '0' }} to {{ $campaigns->lastItem() ?? '0' }} of {{ $campaigns->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $campaigns->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>

@endsection

@section('script')

   <script src="{{ filePath('bladejs/campaigns/index.js') }}"></script>

@endsection