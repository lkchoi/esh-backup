<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESPORTS HERO</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    {{-- <link href="/css/style.css" rel="stylesheet"> --}}
    <link href="/css/app.css" rel="stylesheet">
    @yield('head')
</head>
<body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top container" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="/" class="navbar-brand">ESPORTS HERO</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Play <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="">Open Matches</a></li>
                                    <li><a href="">Leaderboard</a></li>
                                    <li><a href="">Find Users</a></li>
                                </ul>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="">Spectate</a>
                            </li>
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Learn <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="">How It Works</a></li>
                                    <li><a href="">Learning Center</a></li>
                                    <li><a href="">FAQs</a></li>
                                    <li><a href="">Live Events</a></li>
                                    <li><a href="">Hearthstone Team</a></li>
                                    <li><a href="">Sponsored Teams</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Create <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="">Create Match</a></li>
                                </ul>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="">Shop</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            @if (Auth::guest())
                            <li class="active">
                                <a href="/register" class="text-lg">
                                    Register
                                </a>
                            </li>
                            <li class="active">
                                <a href="/login" class="text-lg">
                                    Log In
                                </a>
                            </li>
                            @else
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    {{ Auth::user()->username }}
                                    <span class="caret"></span>
                                </a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="/logout">Logout</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">
                    {{-- right side of footer --}}
                </div>
                <div>
                    <strong>Copyright</strong> eSports Hero &copy; 2016
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>
    <!-- Flot -->
    <script src="/js/plugins/flot/jquery.flot.js"></script>
    <script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.resize.js"></script>
    <!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js"></script>
    <!-- Peity -->
    <script src="/js/plugins/peity/jquery.peity.min.js"></script>
    <!-- Peity demo -->
    <script src="/js/demo/peity-demo.js"></script>
    
    @yield('tail')
</body>
</html>