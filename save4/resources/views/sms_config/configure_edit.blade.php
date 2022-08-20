@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(SMS Settings) - {{ $sms }}</title>
@endsection

@section('subcontent')

<div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="{{ route('sms.index') }}" class="button text-white bg-theme-1 shadow-md mr-2" >
            @translate(SMS List)
        </a>


        @switch($sms)
            @case('viber')

                <a href="javascript:;" data-toggle="modal" 
                    data-target="#superlarge-modal-size-preview"  
                    class="button text-white bg-theme-1 shadow-md mr-2">
                      @translate(New Scenario Key)
                </a>


            <div class="modal" id="superlarge-modal-size-preview">
                <div class="modal__content modal__content--xl p-10"> 
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">@translate(Add New Scenario Key)</h2>
                    </div>
                    <div class="grid grid-cols-12 gap-12 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <!-- BEGIN: Form Layout -->

                            <form class="" 
                            action="{{ route('viber.new.scenario') }}"
                            method="POST">
                            @csrf

                                <div class="mt-3">
                                <div class="input-form"> 
                                    <label class="flex flex-col sm:flex-row"> @translate(API KEY)*</label> 

                                    <input type="text" 
                                    name="sms_token" 
                                    value="{{ $sms_config->sms_token ?? null }}" 
                                    class="input w-full border mt-2" 
                                    placeholder="API TOKEN">

                                    <small>@translate(GET Public API KEY FROM) <a href="https://infobip.com" target="_blank">infobip.com</a> </small>

                                </div>
                                </div>

                                <div class="mt-3">
                                <div class="input-form"> 
                                    <label class="flex flex-col sm:flex-row"> @translate(Flow From)*</label> 
                                    <input type="text" name="flow_from" class="input w-full border mt-2" placeholder="Ex: SoftTech IT">
                                    <small>Ex: SoftTech IT</small>
                                </div>
                                </div>

                                <div class="mt-3">
                                <div class="input-form"> 
                                    <label class="flex flex-col sm:flex-row"> @translate(Flow Email)*</label> 
                                    <input type="text" name="flow_email" class="input w-full border mt-2" placeholder="Ex: support@softtech-it.com">
                                    <small>Ex: support@softtech-it.com</small>
                                </div>
                                </div>
                    
                                <button type="submit"
                                            class="button bg-theme-1 text-white mt-5">@translate(Save)
                                </button>

                            </form>
                                        <!-- END: Form Layout -->
                                
                        </div>
                    </div>
                </div>
            </div>

                
                @break
            @case('whatsapp')

                <a href="javascript:;" data-toggle="modal" 
                    data-target="#superlarge-modal-size-preview"  
                    class="button text-white bg-theme-1 shadow-md mr-2">
                      @translate(New Scenario Key)
                </a>


            <div class="modal" id="superlarge-modal-size-preview">
                <div class="modal__content modal__content--xl p-10"> 
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">@translate(Add New Scenario Key)</h2>
                    </div>
                    <div class="grid grid-cols-12 gap-12 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <!-- BEGIN: Form Layout -->

                            <form class="" 
                            action="{{ route('whatsapp.new.scenario') }}"
                            method="POST">
                            @csrf

                            

                                <div class="mt-3">
                                <div class="input-form"> 
                                    <label class="flex flex-col sm:flex-row"> @translate(API KEY)*</label> 

                                    <input type="text" 
                                    name="sms_token" 
                                    value="{{ $sms_config->sms_token ?? null }}" 
                                    class="input w-full border mt-2" 
                                    placeholder="API TOKEN">

                                    <small>@translate(GET Public API KEY FROM) <a href="https://infobip.com" target="_blank">infobip.com</a> </small>

                                </div>
                                </div>

                                <div class="mt-3">
                                <div class="input-form"> 
                                    <label class="flex flex-col sm:flex-row"> @translate(Flow From)*</label> 
                                    <input type="text" name="flow_from" class="input w-full border mt-2" placeholder="Ex: SoftTech IT">
                                    <small>Ex: SoftTech IT</small>
                                </div>
                                </div>

                                <div class="mt-3">
                                <div class="input-form"> 
                                    <label class="flex flex-col sm:flex-row"> @translate(Flow Email)*</label> 
                                    <input type="text" name="flow_email" class="input w-full border mt-2" placeholder="Ex: support@softtech-it.com">
                                    <small>Ex: support@softtech-it.com</small>
                                </div>
                                </div>
                    
                                <button type="submit"
                                            class="button bg-theme-1 text-white mt-5">@translate(Save)
                                </button>

                            </form>
                                        <!-- END: Form Layout -->
                                
                        </div>
                    </div>
                </div>
            </div>
                @break

            @default
                
        @endswitch

        @switch($sms)
            @case('viber')

            <a href="{{ route('config.doc', 'viber') }}" target="_blank" class="text-theme-6 mr-2 row tooltip" title="Learn how to configure">
             <i data-feather="help-circle"></i>
            </a>
                
                @break
            @case('whatsapp')

            <a href="{{ route('config.doc', 'whatsapp') }}" target="_blank" class="text-theme-6 mr-2 row tooltip" title="Learn how to configure">
             <i data-feather="help-circle"></i>
            </a>
                
                @break
            @case('infobip')

            <a href="{{ route('config.doc', 'infobip') }}" target="_blank" class="text-theme-6 mr-2 row tooltip" title="Learn how to configure">
             <i data-feather="help-circle"></i>
            </a>
                
                @break
            @default
                
        @endswitch

        
        
        </div>

  <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ Str::upper( $sms ) }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
            <!-- BEGIN: Social Information -->
            <div class="intro-y box lg:mt-5" id="#social">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Sms Gateway Information)</h2>
                </div>
                <div class="p-5">
                    <form method="POST" action="{{ route('sms.admin.configure.update', $sms) }}">
                        @csrf
                        <input type="hidden" value="{{ $sms_config->id }}" name="id">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mt-3 hidden">
                                <label class="tooltip" title="@translate(Not allowd to write)">@translate(SMS NAME)</label>
                                <input readonly type="text" name="sms_name" class="input w-full border mt-2 disabled:opacity-50 cursor-not-allowed tooltip" title="@translate(Not allowd to write)" placeholder="SMS NAME" 
                                value="{{ $sms }}"
                                >
                            </div>

                            @can('Admin')
                            <div class="mt-3">
                                @switch($sms)
                                    @case('lao')
                                        <label>@translate(PRIVATE KEY)</label>
                                        @break
                                    
                                    @default
                                    <label>@translate(TOKEN/SECRET)</label>
                                @endswitch
                                <input type="text" 
                                        name="sms_token" 
                                        class="input w-full border mt-2" 
                                        placeholder="@switch($sms) @case('lao') PRIVATE KEY @break @default TOKEN/SECRET @endswitch " 
                                        value="{{ $sms_config->sms_token ?? null }}">
                            </div>

                            @endcan

                            <div class="mt-3">
                                    <label>@translate(SMS NUMBER)</label>
                                <input type="text" 
                                        name="sms_number" 
                                        class="input w-full border mt-2" 
                                        placeholder="SMS NUMBER" 
                                        value="{{ $sms_config->sms_number ?? null }}">
                            </div>

                            @if ($sms == 'lao')
                                
                            @endif
                        </div>
                        <div class="col-span-12 xl:col-span-6">

                            @can('Admin')
                            @if ($sms == 'infobip')
                            
                            <div class="mt-3">
                                <label>
                                    @switch($sms)
                                        @case('viber')
                                            @translate(Scenario Key)
                                            
                                            @break

                                        @default
                                        @translate(ID/KEY)
                                            
                                    @endswitch
                                
                                </label>
                                <input type="text" 
                                placeholder=
                                    @switch($sms)
                                        @case('viber')
                                            "Scenario Key"
                                            
                                            @break

                                        @default
                                            "ID/KEY"
                                            
                                    @endswitch
                                
                                class="input w-full border mt-2" 
                                name="sms_id" 
                                value="{{ $sms_config->sms_id ?? null }}">
                            </div>


                            <div class="mt-3">
                                    <label>@translate(URL)</label>
                                <input type="text" 
                                        name="url" 
                                        class="input w-full border mt-2" 
                                        placeholder="URL" 
                                        value="{{ $sms_config->url ?? null }}">
                            </div>

                                
                            @endif

                            @endcan

                        

                            <div class="mt-3">
                                    <label>@translate(SMS FROM)</label>
                                <input type="text" 
                                        name="sms_from" 
                                        class="input w-full border mt-2" 
                                        placeholder="SMS FROM" 
                                        value="{{ $sms_config->sms_from ?? null }}">
                            </div>

                            
                        </div>

                        
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="button w-20 bg-theme-1 text-white ml-auto">@translate(Save)</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- END: Social Information -->


        </div>
    </div>

    @switch($sms)
        @case('viber')
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
                        <!-- BEGIN: Social Information -->
                        <div class="intro-y box lg:mt-5" id="#social">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">@translate(Viber Flow List)</h2>
                            </div>
                            <div class="p-5">
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Key</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">From</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse (scenarioes('viber') as $scenario)

                                            <tr>
                                                <td class="border-b whitespace-nowrap">{{ $loop->iteration }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->key }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->flow_name }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->flow_from }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->created_at->diffForHumans() }}</td>
                                            </tr>
                                                
                                            @empty

                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <img src="{{ notFound('no-scenarios.png') }}" class="m-auto" alt="no scenarios">
                                                </td>
                                            </tr>
                                                
                                            @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @case('whatsapp')
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
                        <!-- BEGIN: Social Information -->
                        <div class="intro-y box lg:mt-5" id="#social">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">@translate(WhatsApp Flow List)</h2>
                            </div>
                            <div class="p-5">
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Key</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">From</th>
                                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @forelse (scenarioes('whatsapp') as $scenario)

                                            <tr>
                                                <td class="border-b whitespace-nowrap">{{ $loop->iteration }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->key }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->flow_name }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->flow_from }}</td>
                                                <td class="border-b whitespace-nowrap">{{ $scenario->created_at->diffForHumans() }}</td>
                                            </tr>
                                                
                                            @empty

                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <img src="{{ notFound('no-scenarios.png') }}" class="m-auto" alt="no scenarios">
                                                </td>
                                            </tr>
                                                
                                            @endforelse
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @default
            
    @endswitch

    
                                    
                                

@endsection

@section('script')
   
@endsection