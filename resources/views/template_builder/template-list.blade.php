@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Email Templates)</title>
@endsection

@section('subcontent')
  
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">@translate(Email Templates) ({{ $templateCount }})</h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="{{ route('template.builder.originate') }}" class="button text-white bg-theme-1 shadow-md mr-2">@translate(Add New Email Templates)</a>
        <a href="{{ route('import.template') }}" class="button text-white bg-theme-1 shadow-md mr-2">@translate(Import Templates)</a>
    </div>
</div>
<div class="intro-y {{ $templates->count() != 0 ? 'grid grid-cols-12 gap-6' : '' }} mt-5">
    <!-- BEGIN: Blog Layout -->

    @forelse ($templates as $template)
        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-3 box">
            <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
                <div class="w-10 h-10 flex-none image-fit">
                    <img alt="{{ $template->title }}" class="rounded-full" src="{{ commonAvatar($template->title) }}">
                </div>
                <div class="ml-3 mr-auto">
                    <a href="javascript:;" class="font-medium">{{ Str::upper($template->title) }} 
                    
                        @if (pro_builder_supported($template->id))
                        <div class="py-1 px-2 rounded-full text-xs bg-theme-4 text-white cursor-pointer inline font-medium">Pro builder support</div>
                        @endif
                    
                    </a>
                    <div class="flex text-gray-600 truncate text-xs mt-1">
                        <span class="mx-1">•</span> {{ $template->created_at->diffForhumans() }}
                    </div>
                </div>
                <div class="dropdown ml-3">
                    <a href="javascript:;" class="dropdown-toggle w-5 h-5 text-gray-500 dark:text-gray-300">
                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                    </a>
                    <div class="dropdown-box w-40">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">


                            <a href="{{ route('template.preview', $template->id) }}" target="_blank" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> @translate(Preview)
                            </a>


                            <a href="{{ route('template.duplicate', $template->id) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="copy" class="w-4 h-4 mr-2"></i> @translate(Duplicate)
                            </a>


                            <a href="{{ route('template.builder.edit', [$template->id, $template->slug]) }}" target="_blank" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> @translate(Edit Template Classic Editor)
                            </a>

                            @if (pro_builder_supported($template->id))
                            <a href="javascript:;" 
                                target="_blank" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                                onclick="event.preventDefault();
                                                    document.getElementById('pro-editor-edit{{ $template->id }}').submit();">
                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> @translate(Edit Template Pro Editor)

                                <form id="pro-editor-edit{{ $template->id }}" action="{{ route('pro.template.builder.edit') }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" value="{{ $template->id }}" name="template_id">
                                    <input type="hidden" value="{{ $template->slug }}" name="template_slug">
                                </form>
                            </a>
                            @endif

                            <a href="{{ route('template.builder.edit.thumbnail', [$template->id, $template->slug]) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="image" class="w-4 h-4 mr-2"></i> @translate(Edit Thumbnail)
                            </a>

                            <a href="{{ route('template.builder.delete', [$template->id, $template->slug]) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="trash" class="w-4 h-4 mr-2"></i> @translate(Delete Template)
                            </a>



                        </div>
                    </div>
                </div>
            </div>


            <div class="p-1">
                <div class="h-60 xxl:h-60 image-fit">
                    
                    <div class="rounded-md preview-template">
                        <div style="background-image: url('{{ asset($template->preview ?? notFound('no-preview.png')) }}');" class="preview-template"></div>
                    </div>

                </div>
            </div>
    
        </div>
    @empty
        <img src="{{ notFound('template-not-found.png') }}" class="m-auto no-shadow" alt="#sms-not-found">
    @endforelse
    <!-- END: Blog Layout -->
        {{ $templates->links('vendor.pagination.bootstrap-4') }}
</div>

@endsection

@section('script')

 
@endsection