@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(SMS Templates)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(SMS Templates)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('builder.sms.create') }}" class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" title="@translate(Add new SMS Templates)">@translate(Add New SMS Templates)</a>
            
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="smsIndex">
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
                        <th class="whitespace-no-wrap">@translate(NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(BODY)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody class="smsName">
                    @forelse ($templates as $template)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="{{ $template->name }}" class="tooltip rounded-full" src="{{ namevatar($template->name) }}" title="{{ $template->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-no-wrap tooltip inline-block" title="{{ $template->name  }}">{{$template->name }}</a>
                            </td>
                            
                            <td class="text-center tooltip" title="{{ strip_tags($template->body) }}">{{ strip_tags($template->body) }}</td>
                            
                            <td class="w-40">
                                <div class="flex items-center tooltip justify-center {{ $template->status == 1 ? 'text-theme-9' : 'text-theme-6' }}"
                                    title="{{ $template->status == 1 ? 'Active' : 'Inactive' }}"
                                    >
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $template->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            <td class="text-center tooltip w-40" title="{{ $template->created_at->diffForHumans() }}">{{ $template->created_at->diffForHumans() }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 tooltip" title="@translate(View)" href="{{ route('builder.sms.template.show', $template->id) }}">
                                        <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center mr-3 tooltip" href="{{ route('builder.sms.template.edit', $template->id) }}" title="@translate(Edit)">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" href="{{ route('builder.sms.template.destroy', $template->id) }}" title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                    <td colspan="6">
                            <div class="text-center">
                                <img src="{{ notFound('template-not-found.png') }}" class="m-auto no-shadow" alt="#template-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $templates->firstItem() ?? '0' }} to {{ $templates->lastItem() ?? '0' }} of {{ $templates->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $templates->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>

@endsection

@section('script')
<script src="{{ filePath('bladejs/settings/sms/templates.js') }}"></script>
@endsection