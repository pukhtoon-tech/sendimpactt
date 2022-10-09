@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Drag & Drop Autoresponder Builder)</title>
@endsection
@section('css')
    <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>

    <style>

    .facet-list {
      list-style-type: none;
      margin: 0;
      padding: 0;
      margin-right: 10px;
      background: #eee;
      padding: 5px;
      width: 143px;
      min-height: 1.5em;
      font-size: 0.85em;
    }

    .facet-list li {
      margin-top: 5px;
      padding: 5px;
      font-size: 1.2em;
      border-radius: .25rem;
    }

    .facet-list li.placeholder {
      height: 1.2em
    }

    .facet {
      border: 1px solid #bbb;
      background-color: #fafafa;
      cursor: move;
    }

    .facet.ui-sortable-helper {
      opacity: 0.5;
    }

    .placeholder {
      border: 1px solid #3498db;
      background-color: #2980b9;
      border-radius: .25rem;
    }

    .ml-left-side .facet-list li {
      position: relative;
      z-index: 1;
      margin-bottom: 50px;
    }

    .ml-left-side .facet-list li:last-child {
      margin-bottom: 0;
    }

    .ml-left-side .facet-list li:after {
      content: url("{{asset('arrow-down.svg')}}");
      position: absolute;
      bottom: -15%;
      left: 50%;
      transform: translateX(-50%);
      color: #fff;
    }
    .ml-left-side .facet-list li:last-child::after {
      content: initial
    }

    .ml-left-side {
      position: relative;
    }

    .ml-left-side:after {
      position: absolute;
      content: 'drag & drop here';
      top: 50%;
      left: 50%;
      font-size: 50px;
      text-transform: capitalize;
      transform: translate(-50%,-50%);
      z-index: 0;
      color: #bdc3c7;
    }
    
    </style>

@endsection

@section('subcontent')
<div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Drag & Drop Autoresponder Builder)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-2 sm:py-2 mt-2">
        
        {{-- BUILDER --}}
       
            <div class="grid grid-cols-2 gap-6 mt-5 mb-5">

              <div class="ml-left-side flex items-start px-5 pt-5 pb-5">
                  <form action="{{ route('autoresponder.store', $autoresponder_id) }}" method="post" class="w-full h-full">
                    @csrf

                    <ul id="allFacets" class="facet-list w-full h-full rounded" style="height: 1000px; overflow: auto;">
                       
                    </ul>
                    <button type="submit" class="button text-white bg-theme-1 shadow-md mr-2 mt-2" style="float: right;">Submit</button>
                    </form>
                </div>

                <div class="flex items-start px-5 pt-5 pb-5" style="height: 1000px; overflow: auto;">
                    <ul id="userFacets" class="facet-list w-full h-full rounded">
                        @forelse (emailTemplates() as $emailTemplate)
                            <li class="facet w-full tooltip" title="{{ $emailTemplate->title }}"> 
                              <input type="hidden" name="template_id[]" value="{{ $emailTemplate->id }}"> 
                              <img src="{{ asset($emailTemplate->preview) }}" alt="{{ $emailTemplate->title }}" class="w-full"  style="height: 300px;">
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
             
            </div>
          
        {{-- BUILDER::END --}}

    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script>
    $(function() {
    $("#allFacets, #userFacets").sortable({
      connectWith: "ul",
      placeholder: "placeholder",
      delay: 150
    })
    .disableSelection()
    .dblclick( function(e){
      var item = e.target;
      if (e.currentTarget.id === 'allFacets') {
        //move from all to user
        $(item).fadeOut('fast', function() {
          $(item).appendTo($('#userFacets')).fadeIn('slow');
        });
      } else {
        //move from user to all
        $(item).fadeOut('fast', function() {
          $(item).appendTo($('#allFacets')).fadeIn('slow');
        });
      }
    });
  });
</script>
@endsection