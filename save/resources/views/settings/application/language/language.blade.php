@extends('../layout/side-menu')

@section('subhead')
<title>@translate(Language Settings)</title>
@endsection

@section('subcontent')
    @include('settings.application.language.components.lang_list')
@endsection

@section('script')

@endsection
