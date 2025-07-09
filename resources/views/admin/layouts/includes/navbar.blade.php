<nav class="navbar navbar-expand-md navbar-dark bg-gradient-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="{{ route('admin.home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @if (Auth::guard('admin')->guest())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('admin')->user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
