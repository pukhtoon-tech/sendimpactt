  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css'>
  
  <link rel="stylesheet" href="{{ asset('frontend/argon/assets/icon/remixicon/remixicon.css') }}">
  <!-- Plyr - HTML5, YouTube and Vimeo media player -->
  <link rel="stylesheet" href="{{ asset('frontend/argon/assets/css/plyr.min.css') }}">
  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="{{ asset('frontend/argon/assets/css/aos.min.css') }}">
  <!-- Swiper - Touch Slider -->
  <link rel="stylesheet" href="{{ asset('frontend/argon/assets/css/swiper.min.css') }}">
  <!-- Notify -->
  <link rel="stylesheet" href="{{ asset('frontend/argon/assets/css/jquery.toast.min.css') }}">
  <!-- Maildoll -->
  <link rel="stylesheet" href="{{ asset('frontend/argon/assets/css/findeas.min.css') }}">

@auth
  @can('Admin')
    <link rel="stylesheet" href="{{ asset('frontend/argon/assets/css/style.css') }}">
  @endcan
@endauth