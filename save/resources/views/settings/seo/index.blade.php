@extends('../layout/' . layout())

@section('subhead')
    <title>{{ orgName() }} - Seo</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">@translate(SEO)</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        @include('settings.seo.components.side-menu')
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Company Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Seo Setup)</h2>
                </div>
                <div class="p-5">
                <form action="{{ route('seo.setup') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-5" id="seo">
                        
                        <div class="col-span-12 xl:col-span-8">

                            <div>
                                <label>@translate(Description) <small>@translate(optinal)</small> </label>
                                <input type="text" class="input w-full border bg-gray-100 mt-2" placeholder="Input Name" value="{{ seo('description') ?? null }}" name="description">
                            </div>
                            <div class="mt-3">
                                <label>@translate(keywords) <small>@translate(optinal)</small> <small>Ex: sms, email, marketing</small> </label>
                                <input type="text" class="input w-full border bg-gray-100 mt-2" name="keywords" value="{{ seo('keywords') ?? null }}">
                            </div>

                            <div class="mt-3">
                                <label>@translate(Google Analytics Script)</label>
                                <div class="mt-2">
                                    <textarea rows="8" class="resize-none border rounded-md w-full" name="google_analytics">{{ seo('google_analytics') ?? null }}</textarea>
                                </div>
                            </div>
                          
                        </div>
                </div>

                <div class="flex justify-start mt-4">
                            <button type="submit" class="button w-20 bg-theme-1 text-white ml-auto">@translate(Save)</button>
                        </div>
            </form>
                </div>
            </div>
            <!-- END: Company Information -->
           
        </div>
    </div>
@endsection
