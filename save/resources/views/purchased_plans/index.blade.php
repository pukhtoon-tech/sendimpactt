@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Purchased Plans)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Purchased Plans)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="mailLogIndex">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(PURCHASE ID)</th>
                        <th class="text-center whitespace-no-wrap">@translate(INVOICE NO)</th>
                        <th class="text-center whitespace-no-wrap">@translate(PLAN NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(GATEWAY)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(DATE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                    </tr>
                </thead>
                <tbody class="mailLogName">
                    @forelse (purchased(20) as $purchases)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $purchases->id }}" class="tooltip rounded-full" src="{{ commonAvatar($purchases->id) }}" title="{{ $purchases->id }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="#{{ $purchases->invoice }}">#{{ $purchases->invoice }}</td>
                            <td class="text-center tooltip" title="{{ Str::upper($purchases->plan_name) }}">{{ Str::upper($purchases->plan_name) }}</td>
                            <td class="text-center tooltip" title="{{ Str::upper($purchases->gateway) }}">{{ Str::upper($purchases->gateway) }}</td>

                            <td class="text-center tooltip {{ $purchases->status === 1 ? 'text-theme-9' : 'text-theme-6' }}" title="{{ $purchases->status == 1 ? 'PAID' : 'NOT PAID' }}">
                                {{ $purchases->status == 1 ? 'PAID' : 'NOT PAID' }}
                            </td>

                            <td class="text-center tooltip" title="{{ $purchases->created_at->diffForHumans() }}">{{ $purchases->created_at }}</td>

                            <td class="text-center tooltip" title="@translate(DOWNLOAD INVOICE)">
                                <a href="{{ route('download.invoice', $purchases->invoice) }}" class="button w-24 bg-theme-1 text-white">@translate(DOWNLOAD INVOICE)</a>
                            </td>
                        </tr>
                    @empty
                    <td colspan="8">
                            <div class="text-center">
                                <img src="{{ notFound('purchase-not-found.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ purchased(20)->firstItem() ?? '0' }} to {{ purchased(20)->lastItem() ?? '0' }} of {{ purchased(20)->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ purchased(20)->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
@endsection

@section('script')
<script src="{{ filePath('bladejs/purchased_plans/index.js') }}"></script>
@endsection