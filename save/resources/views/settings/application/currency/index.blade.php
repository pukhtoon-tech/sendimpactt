@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Currency Settings)</title>
@endsection

@section('subcontent')
    
    <h2 class="intro-y text-lg font-medium mt-10">@translate(Currency Settings)</h2>


    

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="javascript:;" 
                data-toggle="modal" 
                data-target="#superlarge-currency-modal-size-preview" 
                class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" 
                title="@translate(Add New Currency)">
                @translate(Add New Currency)
            </a>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(SL.)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CURRENCY NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(SYMBOL)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CODE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(RATE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ALIGN)</th>
                        <th class="text-center whitespace-no-wrap">@translate(PUBLISH)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                    </tr>
                </thead>
                <tbody class="mailLogName">
                    @forelse ($currencies as $currency)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $currency->id }}" class="tooltip rounded-full" src="{{ commonAvatar($currency->id) }}" title="{{ $currency->id }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="@translate(Currency Name)">{{ $currency->name }}</td>
                            <td class="text-center tooltip" title="@translate(Currency Symbol)">{{ $currency->symbol }}</td>
                            <td class="text-center tooltip" title="@translate(Currency Code)">{{ $currency->code }}</td>
                            <td class="text-center tooltip" title="@translate(Currency Rate)">{{ $currency->rate }}</td>
                            <td class="text-center tooltip" title="@translate(Alignment)">

                                <input 
                                type="checkbox" 
                                class="input input--switch border" 
                                data-id="{{$currency->id}}" 
                                data-url="{{route('currencies.align')}}" 
                                {{$currency->align == true ? 'checked':null}}>

                            </td>

                            <td class="text-center">

                                @if ($currency->code == 'USD')
                                <span class="bg-theme-14 text-theme-10">
                                    @translate(System Currency)
                                </span>
                                @else


                                @if ( Session::get('currency') != $currency->id)
                                        
                                    <input type="checkbox" 
                                    data-id="{{$currency->id}}" 
                                    data-url="{{route('currencies.published')}}" 
                                    class="input input--switch border" 
                                    {{ $currency->is_published == true ? 'checked' : null }}>

                                @else

                                <a href="javascript:;" class="flex items-center mr-3 tooltip" title="@translate(Active currency)">
                                    <i data-loading-icon="puff" data-color="green" class="w-4 h-4 m-auto"></i>
                                </a>
 

                                @endif

                                
                                
                                @endif

                            </td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">

                                    @if ($currency->code == 'USD')
                                <span class="bg-theme-14 text-theme-10 tooltip" title="@translate(Not allowed to do any action)">
                                    @translate(System Currency)
                                </span>
                                @else
                                    
                                    <a class="flex items-center mr-3 tooltip" 
                                    title="@translate(Edit)" 
                                    href="{{ route('currencies.edit', $currency->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>

                                    @if ( Session::get('currency') != $currency->id)
                                        
                                    <a class="flex items-center mr-3 tooltip text-theme-6" title="@translate(Delete)" href="{{ route('currencies.destroy', $currency->id) }}">
                                        <i data-feather="trash" class="w-4 h-4 mr-1"></i>
                                    </a>

                                    @else

                                    <a href="javascript:;" class="flex items-center mr-3 tooltip" title="@translate(Active currency)">
                                        <i data-loading-icon="puff" data-color="green" class="w-4 h-4"></i>
                                    </a>

 

                                    @endif
                                    

                                    @endif
                                  
                                </div>
                            </td>

                        </tr>
                    @empty
                    <td colspan="8">
                            <div class="text-center">
                                <img src="{{ notFound('currency.png') }}" class=" w-6/12 m-auto no-shadow" alt="#currency-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $currencies->firstItem() ?? '0' }} to {{ $currencies->lastItem() ?? '0' }} of {{ $currencies->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $currencies->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->

    </div>



    {{-- modal --}}


                        <div class="modal" id="superlarge-currency-modal-size-preview">
                            <div class="modal__content modal__content--xl p-10"> 
                                <div class="intro-y flex items-center mt-8">
                                    <h2 class="text-lg font-medium mr-auto">@translate(Add New Currency)</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-12 mt-5">
                                    <div class="intro-y col-span-12 lg:col-span-12">
                                        <!-- BEGIN: Form Layout -->

                                        <form class="" 
                                            enctype="multipart/form-data"
                                            action="{{ route('currencies.store') }}"
                                            method="POST">
                                            @csrf

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Currency Name) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: United State</span>
                                                    </label> <input type="text" name="name" class="input w-full border mt-2" placeholder="Currency Name" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Currency Symbol) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: $</span>
                                                    </label> <input type="text" name="symbol" class="input w-full border mt-2" placeholder="Currency Symbol" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Currency Code) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Ex: USD</span>
                                                    </label> <input type="text" name="code" class="input w-full border mt-2" placeholder="Currency Code" data-parsley-required>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="input-form"> <label class="flex flex-col sm:flex-row"> @translate(Exchange Rate) <span
                                                            class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Exchange Rate Ex: 1 USD = ? </span>
                                                    </label> <input type="number" name="rate" min="1" step="0.01" class="input w-full border mt-2" placeholder="Exchange Rate" data-parsley-required>
                                                </div>
                                            </div>

                                

                                           

                                                <button type="submit"
                                                    class="button bg-theme-1 text-white mt-5">@translate(Release Currency)</button>
                                        </form>
                                        <!-- END: Form Layout -->
                                
                                    </div>
                                </div>
                                </div>
                        </div>


                        {{-- modal::END --}}
                        
  

@endsection

@section('script')

@endsection
