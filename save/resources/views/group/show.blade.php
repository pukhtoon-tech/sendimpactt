@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Group) - {{ $group->name }}</title>
@endsection

@section('subcontent')

<div class="intro-y news p-5 box mt-8">
        <!-- BEGIN: Blog Layout -->
        <h2 class="intro-y font-medium text-xl sm:text-2xl">{{ Str::upper($group->name) }}</h2>
        <div class="intro-y text-gray-700 dark:text-gray-600 mt-3 text-xs sm:text-sm">
            {{ $group->created_at->diffForHumans() }}
        </div>
       
        <div class="intro-y text-justify leading-relaxed pt-16 sm:pt-6 pb-6">
            <p class="mb-5">{{ strip_tags($group->description) }}</p>
        </div>
     
        <!-- END: Blog Layout -->
        <!-- BEGIN: Comments -->
        <div class="intro-y mt-5 pt-5 border-t border-gray-200 dark:border-dark-5">
            <div class="text-base sm:text-lg font-medium">{{ count(emailGroupEmails($group->id)) }} @translate(Emails)</div>
            <div class="news__input relative mt-5">
                <i data-feather="search" class="w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"></i>
                <input type="search" id="groupInput" class="input w-full bg-gray-200 pl-16 py-6 placeholder-theme-13 resize-none tooltip" title="@translate(Search Mail)" rows="1" placeholder="@translate(Search Email)">
            </div>
        </div>
        <div class="intro-y mt-5 pb-10">
            <div class="pt-5">
                

                <div class="overflow-x-auto sm:overflow-x-visible myTable">
                    @forelse (emailGroupEmails($group->id) as $email)
                        <div class="intro-y" id="groupTable">
                            <div class="inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 dark:bg-dark-1 border-b border-gray-200 dark:border-dark-1">
                                <div class="flex px-5 py-3 groupEmails">
                                    <div class="w-56 flex-none flex items-center mr-10">                                  
                                        <div class="w-6 h-6 flex-none image-fit relative ml-5 email">
                                            <img alt="{{ $email->emails->email }}" class="rounded-full tooltip" title="{{ $email->emails->email }}" src="{{ emailAvatar($email->emails->email) }}">
                                        </div>
                                    </div>

                                    
                                    <div class="grid grid-cols-3 w-full gap-4">
                                        
                                        <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight tooltip" title="{{ $email->emails->email }}"><label for="{{ $email->emails->id }}">{{ $email->emails->email }}</label></span>
                                        
                                    </div>

                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight tooltip" title="{{ $email->emails->name }}"><label for="{{ $email->emails->id }}">{{ $email->emails->name }}</label></span>
                                    </div>

                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight tooltip" title="{{ $email->emails->phone }}"><label for="{{ $email->emails->id }}">{{ $email->emails->phone }}</label></span>
                                    </div>
                                    </div>


                                    
                                    <div class="inbox__item--time whitespace-no-wrap ml-auto pl-10 tooltip" title="{{ $email->emails->created_at->format('H:i a') }}">{{ $email->emails->created_at->format('H:i a') }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">@translate(No Email Found)</div>
                    @endforelse

                </div>


            </div>
       
        </div>
        <!-- END: Comments -->
    </div>
  
@endsection

@section('script')
<script src="{{ filePath('bladejs/group/show.js') }}"></script>
@endsection