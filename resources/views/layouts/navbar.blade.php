<nav class="navbar navbar-static-top container" role="navigation">
    <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <i class="fa fa-reorder"></i>
        </button>
        <a href="/" class="navbar-brand">
            <img src="/img/logo-359x70.png" alt="ESPORTS HERO">
        </a>
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
                    <li><a href="/matches/create">Create Match</a></li>
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
