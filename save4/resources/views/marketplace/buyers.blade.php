@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Marketplace Buyers)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Marketplace Buyers)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            
        <a href="{{ route('marketplace.index') }}"
            class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" 
            title="@translate(Go Back to Marketplace Dashboard)">
            @translate(Go Back To Marketplace Dashboard)
        </a>
            
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0 hidden">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="emailList">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>

        </div>


        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(SALE ID)</th>
                        <th class="text-center whitespace-no-wrap">@translate(NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(EMAIL)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CSV AMOUNT)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CSV COUNTRY)</th>
                        <th class="text-center whitespace-no-wrap">@translate(PRICE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(TYPE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(PURCHASED DATE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                    </tr>
                </thead>
                <tbody class="mailLogName">
                    @forelse ($marketplace_buyers as $marketplace_buyer)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $marketplace_buyer->id }}" class="tooltip rounded-full" src="{{ commonAvatar($marketplace_buyer->id) }}" title="{{ $marketplace_buyer->id }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="@translate(SALE ID)">
                                {{ $marketplace_buyer->name }}
                            </td>
                            <td class="text-center tooltip" title="@translate(EMAIL)">{{ $marketplace_buyer->email }}</td>
                            <td class="text-center tooltip" title="@translate(CSV AMOUNT)">{{ $marketplace_buyer->email_amount }}</td>
                            <td class="text-center tooltip" title="@translate(CSV COUNTRY)">{{ Str::after($marketplace_buyer->file_path, base_path('public/output/')) }}</td>
                            <td class="text-center tooltip" title="@translate(PRICE)">{{ '$' . $marketplace_buyer->price }}</td>
                            <td class="text-center tooltip" title="@translate(TYPE)">{{ $marketplace_buyer->type }}</td>
                            <td class="text-center tooltip" title="@translate(STATUS)">{{ $marketplace_buyer->status }}</td>
                            <td class="text-center tooltip" title="@translate(PURCHASED DATE)">{{ $marketplace_buyer->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('marketplace.send.file.to.buyer', $marketplace_buyer->id) }}" 
                                   class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip"
                                   title="@translate(Send File To Email)">
                                    @translate(Send File)
                                </a>
                            </td>
                        </tr>
                    @empty
                     <td colspan="6">
                            <div class="text-center">
                                <img src="{{ notFound('log.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $marketplace_buyers->firstItem() ?? '0' }} to {{ $marketplace_buyers->lastItem() ?? '0' }} of {{ $marketplace_buyers->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $marketplace_buyers->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
@endsection

@section('script')
@endsection