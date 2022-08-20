@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Bounce Email)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Bounce Email)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="bounceIndex">
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
                        <th class="whitespace-no-wrap">@translate(EMAIL)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CAMPAIGN ID)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                    </tr>
                </thead>
                <tbody class="bounceName">
                    @forelse ( bounced() as $bounce)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="{{ $bounce->email ?? 'N\A' }}" class="tooltip rounded-full" src="{{ namevatar($bounce->email) ?? namevatar('N\A') }}" title="{{ $bounce->email ?? 'N\A' }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-no-wrap tooltip inline-block" title="{{ $bounce->email ?? 'N\A' }}">{{$bounce->email ?? 'N\A' }}</a>
                            </td>
                            
                            <td class="text-center">{{ $bounce->campaign->name ?? 'N\A' }}</td>

                            <td class="text-center">{{ $bounce->created_at->diffForHumans() ?? 'N\A' }}</td>

                        </tr>
                    @empty
                    <td colspan="4">
                            <div class="text-center">
                                <img src="{{ notFound('bounce.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ bounced()->firstItem() ?? '0' }} to {{ bounced()->lastItem() ?? '0' }} of {{ bounced()->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ bounced()->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>

@endsection

@section('script')
<script src="{{ filePath('bladejs/bounce.js') }}"></script>
@endsection