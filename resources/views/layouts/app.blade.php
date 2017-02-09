<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{Config::get('app.name')}}</title>
    <!-- Styles -->
    <link href='/css/droidarabickufi.css' rel='stylesheet' type='text/css'/>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap-rtl.css">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ trans('app.Home') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/products') }}">{{ trans('app.Products') }}</a></li>
                        <li><a href="{{ url('/purchaseInvoice') }}">{{ trans('app.Purchase Invoice') }}</a></li>
                        <li><a href="{{ url('/orders') }}">{{ trans('app.Orders') }}</a></li>
                        <li><a href="{{ url('/clients') }}">{{ trans('app.Clients') }}</a></li>
                        <li><a href="{{ url('/suppliers') }}">{{ trans('app.Suppliers') }}</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">{{ trans('app.Login') }}</a></li>
                            <li><a href="{{ url('/register') }}">{{ trans('app.Register') }}</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                     {{ trans('app.admin') }}  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     {{ trans('app.Logout') }}
                                            
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <!-- JavaScripts -->
    <script src="{{ asset ("/js/jquery-2.2.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/js/bootstrap3-typeahead.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/js/bootstrap-datepicker.min.js") }}" type="text/javascript"></script>

    
    @yield('javascript')
</body>
</html>
