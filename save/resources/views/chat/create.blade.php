@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Chat Provider)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Create Chat Provider)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('chat.store') }}" method="POST">
                @csrf

                <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">

                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Chat Provider Name)</label>
                        <input type="text" class="input w-full border mt-2" name="name" placeholder="Chat Provider Name" data-parsley-required>
                    </div>

                    
                    <div class="mt-3">
                        <label>@translate(Chat Provider Script)</label>
                        <div class="mt-2">
                            <textarea rows="8" class="resize-none border rounded-md w-full" name="body" data-parsley-required></textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Active Status</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" class="input input--switch border" name="status">
                        </div>
                    </div>


                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Next</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

    {{-- ALL PROVIDERS --}}
     <h2 class="intro-y text-lg font-medium mt-10">@translate(Chat Providers)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
      
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(ICON)</th>
                        <th class="whitespace-no-wrap">@translate(NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(Display/Hide)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody class="smsName">
                    @forelse ($chats as $chat)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="{{ $chat->name }}" class="tooltip rounded-full" src="{{ namevatar($chat->name) }}" title="{{ $chat->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-no-wrap tooltip inline-block" title="{{ $chat->name  }}">{{$chat->name }}</a>
                            </td>


                            
                            <td class="w-40">
                                <div class="flex items-center tooltip justify-center {{ $chat->status == 1 ? 'text-theme-9' : 'text-theme-6' }}"
                                    title="{{ $chat->status == 1 ? 'Active' : 'Inactive' }}"
                                    >
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $chat->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            
                            <td class="w-40">
                                <a href="{{ route('chat.active', $chat->id) }}" 
                                    class="font-medium whitespace-no-wrap tooltip inline-block button w-24 {{ $chat->status == 1 ? 'bg-theme-6' : 'bg-theme-1' }} text-white" 
                                    title="{{ $chat->status == 1 ? 'Hide' : 'Display' }}">
                                    {{ $chat->status == 1 ? 'Hide' : 'Display' }}
                                </a>
                            </td>
                        

                            <td class="text-center tooltip w-40" title="{{ $chat->created_at->diffForHumans() }}">{{ $chat->created_at->diffForHumans() }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">

                                    <a class="flex items-center mr-3 tooltip" href="{{ route('chat.edit', $chat->id) }}" title="@translate(Edit)">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>

                                    <a class="flex items-center text-theme-6 tooltip" href="{{ route('chat.destroy', $chat->id) }}" title="@translate(Delete)">
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
            <div class="md:block mx-auto text-gray-600">Showing {{ $chats->firstItem() ?? '0' }} to {{ $chats->lastItem() ?? '0' }} of {{ $chats->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $chats->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
    {{-- ALL PROVIDERS::END --}}

@endsection

@section('script')
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection