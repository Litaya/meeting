<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">

    <script src="/js/app.js"></script>
    <script src="/js/datetime.js"></script>

    {!! fa_assets() !!}

    <style>
        .modal-open{
            margin:0;
        }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
			'csrfToken' => csrf_token(),
		]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top" style="margin:0;">
        <div class="container">
            <div class="navbar-header" style="padding-left: 50px;">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(Auth::user())
                        @if(in_array(Auth::user()->type,[0,3,4]))
                            <li><a href="{{ route('reserve.index') }}">会议预定</a></li>
                            <li><a href="{{ route('project.index') }}">我的项目</a></li>
                        @endif
                        @if(Auth::user()->type == 3)
                            <li><a href="{{ route('department.index') }}">我的部门</a></li>
                        @endif
                        @if(Auth::user()->type == 4)
                        @endif
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">登录</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        退出登录
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

    <div>
        @if(Session::has('message'))
            <div class="col-lg-12">
                <div class="panel panel-{{Session::has('status')?Session::get('status'):'default'}}">
                    <div class="panel-body">
                        {{ Session::get('message') }}
                    </div>
                </div>
            </div>
        @endif
        @yield('content')
    </div>
</div>

<!-- Scripts -->

</body>
</html>
