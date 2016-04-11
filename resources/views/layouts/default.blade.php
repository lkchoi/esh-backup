<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESPORTS HERO</title>
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/plugins.css" rel="stylesheet">
    @yield('head')
</head>
<body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                @include('layouts.navbar')
            </div>
            <div class="wrapper wrapper-content">
                <div class="container">
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
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>
    <script type="text/javascript" src="/js/plugins/selectize.min.js"></script>
    <script src="/js/app.js"></script>

    @yield('tail')
</body>
</html>