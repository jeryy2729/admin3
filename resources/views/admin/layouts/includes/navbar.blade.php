<nav class="navbar navbar-expand-md navbar-dark bg-gradient-custom shadow-sm">
    <div class="container">
        {{-- App Name --}}
        <a class="navbar-brand fw-bold text-white" 
           href="{{ Auth::guard('admin')->check() ? route('admin.home') : (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('blogger') ? route('posts.index') : '#') }}">
            {{ __('messages.dashboard') }}
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
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $admin->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 p-2" style="min-width: 220px;">

                            {{-- Edit Profile --}}
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile.edit') }}">
                                <i class="fas fa-user-circle me-2 text-primary"></i>
                                <span>Edit Profile</span>
                            </a>

                            {{-- Logout --}}
                            <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                <span>Logout</span>
                            </a>
                            <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <div class="dropdown-divider"></div>

                            {{-- Language Selector --}}
                            <div class="px-2">
                                <label for="language" class="form-label fw-semibold small text-muted mb-1">
                                    <i class="bi bi-translate me-1 text-primary"></i> Language
                                </label>
                                <select id="language" class="form-select form-select-sm border-primary rounded-2"
                                        onchange="location = this.value">
                                    @if($clang)
                                        <optgroup label="🌟 Current">
                                            <option value="{{ route('setLocale', $clang->code) }}" selected>
                                                {{ $clang->name }}
                                            </option>
                                        </optgroup>
                                    @endif
                                    @if($olang->count())
                                        <optgroup label="🌐 Available">
                                            @foreach ($olang as $lang)
                                                <option value="{{ route('setLocale', $lang->code) }}">
                                                    {{ $lang->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                </select>
                            </div>

                        </div>
                    </li>

                {{-- If Blogger is logged in --}}
                @elseif($blogger)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
