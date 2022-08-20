<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">@translate(Language Settings)</h2>
</div>
<div class="grid grid-cols-12 gap-12 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->

        <form class="" 
        enctype="multipart/form-data"
        action="{{ route('language.store') }}"
        method="POST">
        @csrf

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Language Name) 
                </label> <input type="text" name="name" class="input w-full border mt-2" placeholder="Language Name"
                    minlength="2" required> 
                     <label class="flex flex-col sm:flex-row">
                    <small
                        class="sm:ml-auto mt-1 text-right sm:mt-0 text-xs text-gray-600">Ex: @translate(English)</small>
                         </label>
            </div>
            </div>

            <div class="mt-3">
            <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Language Code) 
                </label> <input type="text" name="code" class="input w-full border mt-2" placeholder="Language Code"
                    minlength="2" required>
                 </div>
                 <label class="flex flex-col sm:flex-row">
                 <small
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: en</small>
                        </label>
            </div>


                    <div class="mt-3 text-left"> 
                        <label>@translate(Select Country)</label>
                        <div class="mt-2"> 
                            <select data-search="true" class="tail-select w-full" name="image" required>
                                <option value=""></option>
                                @foreach(readFlag() as $item)
                                    @if ($loop->index >1)
                                        <option value="{{$item}}" data-image="{{asset('assets/lang/'.$item)}}"> {{flagRenameAuto($item)}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
   
       <button type="submit"
                class="button bg-theme-1 text-white mt-5">@translate(Release)</button>
        </form>
        <!-- END: Form Layout -->
   
</div>
</div>