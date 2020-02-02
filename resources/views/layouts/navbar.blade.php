<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse order-last order-lg-first" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/review/create">Review</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->getName() === 'profile' ? 'active' : '' }}" href="/profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="text-decoration-none btn btn-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand">Crime Bois</a>

    <button class="btn btn-light" onclick="location.href = '/profile';">
        <span class="fa fa-user"></span>
    </button>
</nav>
