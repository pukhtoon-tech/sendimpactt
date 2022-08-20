<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <title>Marketplace | {{ orgName() }}</title>

    <!-- Site Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ seo('description') ?? null }}">
    <meta name="keywords" content="{{ seo('keywords') ?? null }}">
    <meta name="author" content="{{ env('AUTHOR') }}">
    <meta name="copyright" content="{{ env('AUTHOR') }}">
    <meta name="version" content="{{ env('VERSION') }}">

    {{-- OPEN GRAPH --}}
    <meta property="og:title" content="@yield('head')" >
    <meta property="og:url" content="{{ org('company_name') ?? 'Maildoll' }}" >
    <meta property="og:image" content="{{ logo() }}" >
    <meta property="og:type" content="website" >
    <meta name="og:description" content="{{ seo('description') ?? null }}">

    {!! seo('google_analytics') ?? null !!}

    <!-- Link Integration -->
    <link rel="icon" type="image/png" href="{{ favIcon() }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/slinky.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/slinky-mobile-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- <link rel="stylesheet" href="css/flags.css"> -->
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/miwlo.css') }}" />
    <link rel="stylesheet" href="{{ asset('marketplace_assets/css/responsive.css') }}" />

    @yield('css')

    @notifyCss
</head>

<body>
  <!-- ================================================================= -->
  <!-- ========================= Loading Area ========================== -->
  <!-- ================================================================= -->
  <div class="loader-wrapper">
    <div class="loader">
      <div class="loading-text">
        <h1>{{ orgName() }}</h1>
      </div>
      <!-- .loading-text -->
    </div>
    <!-- .loader -->
  </div>
  <!-- .loader-wrapper -->

  @yield('content')

  <textarea id="log" class="d-none"></textarea>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Modernizr -->
  <script src="{{ asset('marketplace_assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>

  <!-- Parallax -->
  <script src="{{ asset('marketplace_assets/js/parallax.min.js') }}"></script>
  <script src="{{ asset('marketplace_assets/js/parallax-scroll.js') }}"></script>

  <!-- Animation -->
  <script src="{{ asset('marketplace_assets/js/aos.js') }}"></script>

  <!-- Slider -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <!-- Fonts -->
  <script src="{{ asset('marketplace_assets/js/font-awesome.min.js') }}"></script>

  <!-- Mobile Menu -->
  <script src="{{ asset('marketplace_assets/js/slinky.min.js') }}"></script>

  <!-- Miwlo JS -->
  <script src="{{ asset('marketplace_assets/js/app.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  @yield('js')

@auth
  @can('Admin')
    <link rel="stylesheet" href="{{ asset('frontend/argon/assets/css/style.css') }}">
  @endcan
@endauth

  @auth
      
    @can('Admin')
        
        <script type="text/javascript">
    
            // Editable
            function Editable(sel, options) {
                if (!(this instanceof Editable)) return new Editable(...arguments);

                const attr = (EL, obj) => Object.entries(obj).forEach(([prop, val]) => EL.setAttribute(prop, val));

                Object.assign(this, {
                    onStart() {},
                    onInput() {},
                    onEnd() {},
                    classEditing: "is-editing", // added onStart
                    classModified: "is-modified", // added onEnd if content changed
                }, options || {}, {
                    elements: document.querySelectorAll(sel),
                    element: null, // the latest edited Element
                    isModified: false, // true if onEnd the HTML content has changed
                });

                const start = (ev) => {
                    this.isModified = false;
                    this.element = ev.currentTarget;
                    this.element.classList.add(this.classEditing);
                    this.text_before = ev.currentTarget.textContent;
                    this.html_before = ev.currentTarget.innerHTML;
                    this.onStart.call(this.element, ev, this);
                };

                const input = (ev) => {
                    this.text = this.element.textContent;
                    this.html = this.element.innerHTML;
                    this.isModified = this.html !== this.html_before;
                    this.element.classList.toggle(this.classModified, this.isModified);
                    this.onInput.call(this.element, ev, this);
                }

                const end = (ev) => {
                    this.element.classList.remove(this.classEditing);
                    this.onEnd.call(this.element, ev, this);
                }

                this.elements.forEach(el => {
                    attr(el, {
                        tabindex: 1,
                        contenteditable: true
                    });
                    el.addEventListener("focusin", start);
                    el.addEventListener("input", input);
                    el.addEventListener("focusout", end);
                });

                return this;
            }

            // Use like:
            Editable(".editable", {
                onEnd(ev, UI) { // ev=Event UI=Editable this=HTMLElement
                    if (!UI.isModified) return; // No change in content. Abort here.
                    const data = {
                        cid: this.dataset.cid,
                        text: this.textContent, // or you can also use UI.text
                    }

                    var obj = {
                    cid: data.cid,
                    text: data.text,
                    };

                    $.ajax({
                        type: "GET",
                        url: "{{ route('frontend.json.editor') }}",
                        data: obj,
                        success: function(res) {
                            toastr.success('Successfully uploaded');
                        }
                    });
                }
            });

        </script>

        <script>
            
            for (let index = 1; index < 8; index++) {
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#imagePreview' + index).css('background-image', 'url('+ e.target.result +')');
                            $('#imagePreview' + index).hide();
                            $('#imagePreview' + index).fadeIn(650);
                            var dataImg = $('.liveImagePreview' + index).attr('data-img');

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                            type: 'POST',
                            url: '{{ route("frontend.json.upload") }}',
                            data: {
                                cid: dataImg,
                                text: e.target.result
                            },
                            success: function(data) {
                                toastr.success('Successfully uploaded');
                            }
                            });

                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#imageUpload" + index).change(function() {
                    readURL(this);
                });
            }
            
        </script>

    @endcan
  
@endauth
  

    @include('sweetalert::alert')
    <x:notify-messages />
    @notifyJs

</body>

</html>