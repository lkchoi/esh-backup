<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSports Hero</title>
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/plugins.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    @yield('head')
</head>
<body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                @include('layouts.navbar')
            </div>
            <div class="wrapper wrapper-content">
                <div id="app" class="">
                    @yield('content')
                </div>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> eSports Hero &copy; 2016
                </div>
            </div>
        </div>
    </div>

    @include('layouts.js_vars')

    <script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>
    @yield('tail')
</body>
</html>