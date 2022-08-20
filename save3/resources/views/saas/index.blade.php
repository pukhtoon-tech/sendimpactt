{{-- {{ $message?? 'Nothing is here!' }} --}}


<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ favIcon() }}" rel="shortcut icon">

    <link href="{{ asset('saas/assets/fonts/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('saas/assets/fonts/elegant-fonts.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('saas/assets/bootstrap/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('saas/assets/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('saas/assets/css/style.css') }}" type="text/css">

    <title>{{ orgName() }} | {{ $message?? 'Nothing is here!' }}</title>

</head>

<body class="bg-white">

<div class="page-wrapper">
    <header>
        <div class="brand animate">
            <a href="{{ route('frontend.index') }}">
                {{ orgName() }}
            </a>
        </div>
    </header>
    <div class="content-wrapper">
        <div class="content-main animate">
            <div class="container">
                <h1 class="font-size-36 text-capitalize">{{ $message?? 'Nothing is here!' }}</h1>
            </div>
            <!--end container-->
        </div>
        <!--end content-main-->
        <div class="background-wrapper">
            <div id="background-content"></div>
        </div>
        <!--end background-wrapper-->
    </div>
    <!--end content-wrapper-->
</div>
<!--end page-wrapper-->

<script  src="{{ asset('saas/assets/js/jquery-2.2.1.min.js') }}"></script>
<script  src="{{ asset('saas/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script  src="{{ asset('saas/assets/js/jquery.validate.min.js') }}"></script>
<script  src="{{ asset('saas/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script  src="{{ asset('saas/assets/js/sketch.min.js') }}"></script>
<script  src="{{ asset('saas/assets/js/custom.js') }}"></script>

<script>

    // Background

    var COLOURS = [ '#61dfff', '#A7EBCA', '#f1c40f', '#ff6767', '#61dfff', '#2ecc71', '#a55eea' ];
    var radius = 0;
    var randomColor = 0;

    Sketch.create({

        container: document.getElementById( 'background-content' ),
        autoclear: false,
        retina: 'auto',

        update: function() {
            radius = 2 + abs( sin( this.millis * 0.003 ) * 50 );
        },

        click: function() {
            randomColor = parseInt( 0 + (COLOURS.length - 0) * Math.random(), 10 ) ;
        },

        touchmove: function() {

            for ( var i = this.touches.length - 1, touch; i >= 0; i-- ) {

                touch = this.touches[i];

                this.lineCap = 'round';
                this.lineJoin = 'round';
                this.fillStyle = this.strokeStyle = COLOURS[ randomColor % COLOURS.length ];
                this.lineWidth = radius;

                this.beginPath();
                this.moveTo( touch.ox, touch.oy );
                this.lineTo( touch.x, touch.y );
                this.stroke();
            }
        }
    });


</script>

</body>