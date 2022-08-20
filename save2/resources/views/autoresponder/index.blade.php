@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Autoresponder)</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">@translate(Autoresponder List)</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('autoresponder.create_step1') }}" class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" title="@translate(Add new Autoresponder)">@translate(Add New Autoresponder)</a>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(ICON)</th>
                        <th class="whitespace-no-wrap">@translate(AUTORESPONDER NAME)</th>
                        <th class="whitespace-no-wrap">@translate(CAMPAIGN CONTACT)</th>
                        <th class="whitespace-no-wrap">@translate(TOTAL CONTACT)</th>
                        <th class="whitespace-no-wrap">@translate(TOTAL TEMPLATES)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($autoresponders as $autoresponder)
                    @if ($autoresponder->campaign != null)
                        
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="{{ $autoresponder->name  }}" class="tooltip rounded-full" src="{{ namevatar($autoresponder->name) }}" title="{{ $autoresponder->name }}">
                                    </div>
                                </div>
                            </td>

                            <td>
                                <a href="javascript:;" 
                                    class="font-medium whitespace-no-wrap tooltip inline-block" 
                                    title="{{ $autoresponder->name  }}">
                                    {{$autoresponder->name }}
                                </a>
                            </td>

                            <td class="text-center tooltip" title="{{ $autoresponder->campaign->name ?? 'campaign missing' }}">{{ $autoresponder->campaign->name ?? 'campaign missing' }}</td>
                            <td class="text-center tooltip" title="{{ $autoresponder->autoresponder_contacts->count() ?? 0 }}">{{ $autoresponder->autoresponder_contacts->count() ?? 0 }}</td>
                            <td class="text-center tooltip" title="{{ $autoresponder->autoresponder_templates->count() ?? 0 }}">{{ $autoresponder->autoresponder_templates->count() ?? 0 }}</td>
                            
                            <td class="w-40">
                                <div class="flex items-center justify-center tooltip {{ $autoresponder->status == 1 ? 'text-theme-9' : 'text-theme-6' }}"
                                    title="{{ $autoresponder->status == 1 ? 'Active' : 'Inactive' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $autoresponder->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            <td class="text-center tooltip" title="{{ $autoresponder->created_at->diffForhumans() }}">{{ $autoresponder->created_at->diffForhumans() }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    
                                    <a class="flex items-center mr-3 tooltip" 
                                        title="@translate(Edit)" 
                                        href="{{ route('autoresponder.edit_step1', $autoresponder->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" 
                                    href="{{ route('autoresponder.destroy', $autoresponder->id) }}" title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endif

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
            <div class="md:block mx-auto text-gray-600">Showing {{ $autoresponders->firstItem() ?? '0' }} to {{ $autoresponders->lastItem() ?? '0' }} of {{ $autoresponders->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $autoresponders->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
@endsection

@section('script')

@endsection