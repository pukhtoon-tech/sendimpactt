@extends('../layout/side-menu')

@section('subhead')
<title>@translate(Translate)</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">@translate(Language List)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="{{ route('language.index') }}" class="button text-white bg-theme-1 shadow-md mr-2" >
            @translate(Language List)
        </a>

        <button class="button bg-theme-4 text-white ml-2 mr-2" type="button" onclick="copy()">@translate(Copy Translations)</button>
        
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible lang-table">
            <table class="table table-report mt-5" id="tranlation-table">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(Serial)</th>
                        <th class="whitespace-no-wrap">@translate(Text)</th>
                        <th class="text-center whitespace-no-wrap">@translate(TRANSLATE TO)</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('language.translate.store') }}" method="post">
                        @csrf

                        <div>
                            
                            <button type="submit" class="button bg-theme-6 text-white">@translate(Translate Now)</button>
    
                            
                            
                        </div>


                        <input type="hidden" name="id" value="{{$lang->id}}">
                    
                        @foreach (openJSONFile('en') as $key => $value)
                            <tr class="intro-x">
                                <td>{{ $loop->index+1 }}</td>
                                    <td class="key">{{ $key }}</td>
                                    <td class="text-center">
                                        <input type="text" class="input value w-full border"
                                            name="translations[{{ $key }}]"
                                            @isset(openJSONFile($lang->code)[$key])
                                            value="{{ openJSONFile($lang->code)[$key] }}"
                                            @endisset>
                                    </td>
                            </tr>
                        @endforeach
                        
                    </form>
                </tbody>
            </table>
        </div>
    </div>
        <!-- END: Data List -->

@endsection

@section('script')

@endsection
