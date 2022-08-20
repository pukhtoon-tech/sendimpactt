@extends('layout.' .  layout())

@section('subhead')
    <title>{{ $campaign->campaign_name->name }}</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">{{ $campaign->campaign_name->name }}</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        @include('components.campaign-statistics')
    </div>
@endsection

@section('script')

<script src="{{ filePath('bladejs/mail-logs/index.js') }}"></script>

@endsection