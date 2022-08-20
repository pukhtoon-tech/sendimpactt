@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Gropus)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Group List)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('group.create') }}" class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" title="@translate(Add New Group)">@translate(Add New Group)</a>
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" id="groupIndex" class="input w-56 box pr-10 placeholder-theme-13 tooltip" title="@translate(Search)" placeholder="Search...">
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
                        <th class="whitespace-no-wrap">@translate(GROUP NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CONTACTS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(TYPE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody class="groupName">
                    @forelse ($groups as $group)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="{{ $group->name }}" class="tooltip rounded-full" src="{{ namevatar($group->name) }}" title="{{ $group->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-no-wrap tooltip inline-block" title="{{ $group->name  }}">{{$group->name }}</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap" data-theme="light">{!! Str::limit($group->description, 150) !!}</div>
                            </td>

                            <td class="text-center">{{ App\Models\EmailListGroup::where('email_group_id' , $group->id)->count() }}</td>

                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $group->status == 1 ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $group->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="{{ $group->type == 'email' ? 'text-theme-10' : 'text-theme-6' }}">
                                    {{ Str::upper($group->type) }}
                                </span>
                            </td>

                            <td class="text-center">{{ $group->created_at->diffForHumans() }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 tooltip" title="@translate(View)" href="{{ route('group.show', $group->id) }}">
                                        <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center mr-3 tooltip" href="{{ route('group.edit', $group->id) }}" title="@translate(Edit)">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" href="{{ route('group.emails.destroy', $group->id) }}" title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                    <td colspan="7">
                        <div class="text-center">
                            <img src="{{ notFound('group-not-found.png') }}" class="m-auto no-shadow" alt="#email-not-found">
                        </div>
                    </td>
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $groups->firstItem() }} to {{ $groups->lastItem() }} of {{ $groups->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $groups->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
    

@endsection

@section('script')
<script src="{{ filePath('bladejs/group/index.js') }}"></script>
@endsection