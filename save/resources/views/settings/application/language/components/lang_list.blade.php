<h2 class="intro-y text-lg font-medium mt-10">@translate(Language List)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="javascript:void(0)" class="button text-white bg-theme-1 shadow-md mr-2" 
        data-toggle="modal" 
        data-target="#superlarge-modal-size-preview">
            @translate(Add New Language)
        </a>
          
            <div class="md:block mx-auto text-gray-600">@translate(Showing) {{ $languages->firstItem() }} @translate(to) {{ $languages->lastItem() }} @translate(of) {{ $languages->total() }} @translate(entries)</div>
            
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(FLAG)</th>
                        <th class="whitespace-no-wrap">@translate(LANGUAGE NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(LANGUAGE CODE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($languages as $language)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="{{ $language->name }}" 
                                        class="tooltip rounded-full cursor-auto" 
                                        src="{{ flag($language->image) }}" 
                                        title="{{ $language->name }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="font-medium whitespace-no-wrap cursor-auto">{{ $language->name }}</a>
                            </td>
                            <td class="text-center">{{ $language->code }}</td>
                            
                            <td class="table-report__action w-75">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{route('language.translate',$language->id)}}">
                                        <i data-feather="align-center" class="w-4 h-4 mr-1"></i> @translate(Translate)
                                    </a>


                                    @if (active_lang('default_language') == $language->code)

                                    <button class="w-16 rounded-full mr-2 bg-theme-14 text-theme-10">@translate(Active)</button>

                                    @else
                                        
                                    <a class="flex items-center mr-3 text-theme-1" href="{{route('language.default',$language->id)}}">
                                        <i data-feather="key" class="w-4 h-4 mr-1"></i> @translate(Set As Default)
                                    </a>


                                    <a class="flex items-center text-theme-6" href="{{route('language.destroy',$language->id)}}">
                                        <i data-feather="trash" class="w-4 h-4 mr-1"></i> @translate(Delete)
                                    </a>
                                    
                                    @endif


                                    
                                </div>
                            </td>
                        </tr>

                        @empty

                        

                        <td colspan="4">
                            <div class="text-center">
                                <img src="{{ notFound('language.png') }}" class=" w-6/12 m-auto no-shadow" alt="#language-not-found">
                            </div>
                        </td>

                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->


        <!-- BEGIN: Pagination -->
        

        {{ $languages->links('vendor.pagination.custom') }}

        <!-- END: Pagination -->


         <!-- BEGIN: Delete Confirmation Modal -->
     <div class="modal" id="superlarge-modal-size-preview">
     <div class="modal__content modal__content--xl p-10"> 
         @include('settings.application.language.components.add_new_lang')
     </div>
 </div>
    <!-- END: Delete Confirmation Modal -->

        <script src="{{ filePath('assets/js/jquery.js') }}"></script>
        <script src="{{ filePath('assets/js/default.js') }}"></script>

