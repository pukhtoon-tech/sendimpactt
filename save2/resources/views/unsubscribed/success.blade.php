@extends('frontend.argon.layouts.master')

@section('content')
	
<section class="space-1 mb-5 mt-10">
    <div class="container bg-primary-3 text-white px-5 py-5 rounded-lg  mt-10">
        <div class="text-center w-lg-75 mx-auto py-5">
            <h2>{{ $text }}</h2>
            <a href="{{ route('frontend.index') }}" class="d-inline-flex align-items-center btn btn-primary mt-4">
                @translate(Go to home)
            </a>
        </div>
    </div>
</section>

@endsection