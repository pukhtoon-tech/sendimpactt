@extends('../layout/' . layout())

@section('subhead')
<title>@translate(Voice Servers)</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('dialer/style.css') }}">
    <style>
        #mydiv {
        position: absolute;
        z-index: 999;
        }

        #mydivheader {
        cursor: move;
        z-index: 9999;
        background: #fff;
        border-radius: 50px;
        }
    </style>
@endsection

@section('subcontent')

<!-- Draggable DIV -->
<div id="mydiv">
  <!-- Include a header DIV with the same name as the draggable DIV, followed by "header" -->
  <div id="mydivheader">
    {{-- DIALER --}}
        @includeWhen(true, 'voice.dialer')
    {{-- DIALER::ENDS --}}
  </div>
</div>

<h2 class="intro-y text-lg font-medium mt-10">@translate(Voice Servers)</h2>
<div class="grid grid-cols-12 gap-6 mt-5">

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        
        @can('Admin')
            <a href="javascript:;" 
                data-toggle="modal" 
                data-target="#superlarge-modal-size-preview-smtp" 
                class="button button--lg flex items-center justify-center w-full bg-theme-4 text-white mt-2">
                <i class="w-4 h-4 mr-2" data-feather="edit-3"></i> @translate(Create New Voice Server)
            </a>
        @endcan

    </div>
        
</div>
        

<div class="grid mt-5">
    @forelse (getVoiceServerWiseList() as $service_provider => $voice_providers)

    <hr>
    <div class="h-16">
        <h2 class="block font-medium text-base mt-5">{{ Str::upper($service_provider) }} SERVER('s)</h2>
    </div>
    <hr>

    <div class="grid grid-cols-2 gap-4 mt-5 mb-5">
        @forelse ($voice_providers as $voice_provider)
        
            <div class="box">
            <div class="flex items-start px-5 pt-5 pb-5">
                <div class="w-full flex flex-col lg:flex-row">
                    
                    <h2 class="block font-medium text-base mt-5">
                        {{ Str::upper($voice_provider->provider) }} @translate(SERVER)
                    </h2>

                    <div class="mt-3">
                    @can('Admin')
                        <h3 class="block mt-3">@translate(Account SID): {{ $voice_provider->account_sid }}</h3>
                        <h3 class="block mt-3">@translate(Token): {{ $voice_provider->auth_token }}</h3>
                        <h3 class="block mt-3">@translate(Phone): {{ $voice_provider->phone }}</h3>
                        @endcan
                        <h3 class="block mt-3">@translate(Say): {{ $voice_provider->say }}</h3>
                        <h3 class="block mt-3">@translate(Audio): 
                            <a href="{{ audioPath($voice_provider->audio) }}" 
                               target="_blank" 
                               class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">
                                    @translate(Download)
                            </a>
                        </h3>
                    </div>

                    <div class="mt-5">
                        @can('Admin')

                        <a href="#"
                           class="button button--sm text-white bg-theme-4 mr-2">
                           @translate(Re-configure)
                        </a>

                        <a href="#"
                           class="button button--sm text-white bg-theme-6 mr-2">
                           @translate(Remove)
                        </a>

                       
                        @endcan

                        @can('Customer')
                        <a href="#"
                           class="button button--sm text-white bg-theme-4 mr-2">
                           @translate(Update Sender Information)
                        </a>
                        @endcan

                        <a href="{{ route('test.initiate_call', [$voice_provider->id, $voice_provider->provider]) }}"
                           class="button button--sm text-white bg-theme-7 mr-2">
                           @translate(Test Calling)
                        </a>

                    </div>

                </div>
            </div>
        </div>
            
        @empty
            
        @endforelse
    </div>
        
    @empty
        
    @endforelse
</div>


{{-- MODAL --}}
<div class="modal" id="superlarge-modal-size-preview-smtp">
     <div class="modal__content modal__content--xl p-10"> 
        <div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">@translate(Add Voice Server)</h2>
</div>
<div class="grid grid-cols-12 gap-12 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->

        <form class="" 
        enctype="multipart/form-data"
        action="{{ route('twilio.voice.store') }}"
        onsubmit="return validateform()"
        name="myform" 
        method="POST">
        @csrf

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row"> @translate(Provider)</label> 
                    <select class="w-full form-select sm:w-1/2" name="provider">
                        @forelse (voice_server_list() as $voice_server_list)
                            <option value="{{ $voice_server_list }}">{{ Str::upper($voice_server_list) }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="account_sid"> @translate(Account SID/Key)*</label> 
                    <input type="text" name="account_sid" class="input w-full border mt-2" id="account_sid" placeholder="Account SID/Key" data-parsley-type="text" required>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="auth_token"> @translate(Auth Token/Secret Key)*</label> 
                    <input type="text" name="auth_token" class="input w-full border mt-2" id="auth_token" placeholder="Auth Token/Secret Key" data-parsley-type="text" required>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="phone"> @translate(Phone Number)*</label> 
                    <input type="text" name="phone" class="input w-full border mt-2" id="phone" placeholder="Phone Number" data-parsley-type="text" required>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="say"> @translate(Greetings Voice Message)</label> 
                    <textarea type="text" name="say" class="input w-full border mt-2" id="say" data-parsley-type="text"></textarea>
                </div>
            </div>

            <div class="mt-6">
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="audio"> @translate(Audio Voice Message)</label> 
                    <input type="file" name="audio" class="input w-full border mt-2" id="audio" data-parsley-type="file" accept=".mp3">
                    <small>only .mp3 file is applicable</small>
                </div>
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="">- @translate(OR) -</label> 
                </div>
                <div class="input-form"> 
                    <label class="flex flex-col sm:flex-row" for="url"> @translate(Audio Voice URL)</label> 
                    <input type="url" name="audio_url" class="input w-full border mt-2" id="url" data-parsley-type="url">
                    <small>only valid url is applicable</small>
                </div>
            </div>


            </div>

            <div>
                <button type="submit" class="button text-white bg-theme-1 mr-2">@translate(Save)</button>
            </div>
   
        </form>
        <!-- END: Form Layout -->
   
</div>
</div>
     </div>
 </div>

{{-- MODAL::END --}}




@endsection

@section('script')
    <script src="{{ asset('dialer/script.js') }}"></script>

    <script>
        // Make the DIV element draggable:
dragElement(document.getElementById("mydiv"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
    </script>
@endsection