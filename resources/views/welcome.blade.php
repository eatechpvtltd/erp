<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @if(isset($generalSetting->institute))
                {{$generalSetting->institute}}
            @else
                UNLIMITED Edu Firm
            @endif
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/hover-min.css') }}" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50pt;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 11pt;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            /* For mobile phones: */
            [class*="col-"] {
                width: 100%;
            }
            @media only screen and (max-width: 600px) {
                /* For tablets: */
                .col-s-1 {width: 8.33%;}
                .col-s-2 {width: 16.66%;}
                .col-s-3 {width: 25%;}
                .col-s-4 {width: 33.33%;}
                .col-s-5 {width: 41.66%;}
                .col-s-6 {width: 50%;}
                .col-s-7 {width: 58.33%;}
                .col-s-8 {width: 66.66%;}
                .col-s-9 {width: 75%;}
                .col-s-10 {width: 83.33%;}
                .col-s-11 {width: 91.66%;}
                .col-s-12 {width: 100%;}

                .title {
                    font-size: 25pt;
                }

                .links > a {
                    font-size: 8pt;
                }

            }

        </style>
    </head>
    <body onload="move()">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        {{--<a href="{{ url('/home') }}">Home</a>--}}
                        <a href="{{ route('dashboard') }}" class="hvr-grow">Dashboard</a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hvr-grow">
                            <i class="ace-icon fa fa-power-off"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>

                    @else
                        @if($generalSetting->public_registration == 1)
                            <a href="{{ route('online-registration.registration') }}" class="user-signup-link online-registration-link hvr-sweep-to-bottom">
                                Online Registration
                            </a>
                        @endif
                        <a href="{{ route('online-registration.find') }}" class="user-signup-link online-registration-link hvr-sweep-to-bottom">
                            Find Registration
                        </a>
                        <a href="{{ route('verification.certificate') }}" class="user-signup-link online-registration-link hvr-sweep-to-bottom">
                            Certificate Verification
                        </a>

                       {{-- <a href="{{ route('register') }}">Register</a>--}}
                    @endauth
                        {{--<a href="{{ route('login') }}" class="hvr-grow">Login</a>--}}
                </div>
            @endif

            <div class="content col-11">
                @if(isset($data['general_setting']->logo))
                    <img id="avatar"  src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$data['general_setting']->logo) }}" width="200" >
                @endif
                <div class="title m-b-md">
                    {{isset(auth()->user()->name)?'Welcome, '.auth()->user()->name:"Welcome to "}}
                </div>
                <div class="title m-b-md" style="font-weight: 600;">
                    @if(isset($generalSetting->institute))
                       <!--{{$generalSetting->institute}}-->
                        Education ERP
                    @else
                        Education ERP
                    @endif
                </div>

                <div class="links">
                    @if (isset($data['welcome_menu']) && $data['welcome_menu']->count() > 0)
                        @foreach($data['welcome_menu'] as $Menu)
                                @if($Menu->page_type == 'content-page')
                                    <a href="{{route('web.page').'/'.$Menu->slug}}" class="hvr-grow">{{ $Menu->title }}</a>
                                @elseif($Menu->page_type =="predefine-link")
                                    <a href="{{route('web.home').'/'.$Menu->slug}}" class="hvr-grow">{{ $Menu->title }}</a>
                                @else
                                    <a href="{{$Menu->link}}" target="_blank" class="hvr-grow">{{ $Menu->title }}</a>
                                @endif
                        @endforeach
                    @else
                        <a href="{{route('web.home')}}" target="" class="hvr-grow">Web Page</a>
                        <a href="{{route('login')}}" target="" class="hvr-grow">Login</a>
                    @endif
                </div>
                <br>
                <div class="progress" id="myProgress">
                    <div id="myBar" class="progress-bar progress-bar-secondary active" role="progressbar"
                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background-color: #6c757d!important;">
                        Redirect to Web Page
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <script>
            // $(document).ready(function () {
            //     move();
            // });

            var i = 0;
            function move() {
                // console.log('we are in move');
                if (i == 0) {
                    i = 1;
                    var elem = document.getElementById("myBar");
                    var width = 1;
                    var id = setInterval(frame, 100);
                    function frame() {
                        if (width >= 100) {
                            clearInterval(id);
                            i = 0;
                            window.location.href = "{{ route('web.home')}}";
                        } else {
                            width++;
                            elem.style.width = width + "%";
                        }
                    }
                }
            }
        </script>
    </footer>
</html>
