@extends('frontend.argon.layouts.master')

@section('content')
	
<section class="space-5 pb-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h1 class="font-weight-bold display-4">{{ argonContent(8000) ?? 'Blog Articles' }}</h1>
        <p class="lead w-lg-75 mx-auto">
            {{ argonContent(8001) ?? 'Dynamically target high-payoff intellectual capital for customized technologies. Objectively integrate emerging core competencies before process-centric communities.' }}
            
        </p>
      </div>
      <div data-aos="fade-up" class="aos-init aos-animate">

        @forelse (all_blogs() as $blog)
        
        <div class="card card-body px-lg-3 py-lg-4 rounded-lg mb-5 hover-scale">
          <div class="row align-items-center justify-content-around">
            <div class="col-md-6 col-lg-5 mb-4 mb-md-0 p-0">
              <a href="{{ route('frontend.blog.show', [$blog->id, Str::slug($blog->title)]) }}">
                <img class="img-fluid rounded-lg" src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}">
              </a>
            </div>
            <div class="col-md-6">
              <span class="font-weight-medium text-primary">{{ $blog->created_at->format('F d, Y') }}</span>
              <a href="{{ route('frontend.blog.show', [$blog->id, Str::slug($blog->title)]) }}" class="d-block h2 font-weight-bold">{{ $blog->title }}</a>
              <div class="d-flex align-items-center mb-3">
                <img class="rounded-pill w-10 h-10 mr-2" src="{{ commonAvatar($blog->user->name) }}" height="36" alt="{{ $blog->user->name }}">
                <h6 class="m-0">{{ $blog->user->name }}</h6>
              </div>
            </div>
          </div>
        </div>

        @empty
            
        @endforelse
      </div>
    </div>
  </section>
		
@endsection