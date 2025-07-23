<nav class="navbar navbar-expand-md navbar-dark bg-gradient-custom shadow-sm">
    <div class="container">
        {{-- App Name --}}
        <a class="navbar-brand fw-bold text-white" 
           href="{{ Auth::guard('admin')->check() ? route('admin.home') : (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('blogger') ? route('posts.index') : '#') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        {{-- Toggle Button --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Links --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto"></ul>

            <ul class="navbar-nav ms-auto">
                @php
                    $admin = Auth::guard('admin')->user();
                    $blogger = Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('blogger')
                        ? Auth::guard('web')->user()
                        : null;
                @endphp

                {{-- If no one is logged in --}}
                @if (!$admin && !$blogger)
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                    </li>

                {{-- If Admin is logged in --}}
                @elseif($admin)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $admin->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                {{-- If Blogger is logged in --}}
                @elseif($blogger)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $blogger->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('blogger-logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="blogger-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
