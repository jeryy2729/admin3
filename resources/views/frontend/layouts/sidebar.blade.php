<div class="col-md-3 px-0 d-none d-md-block">
    <div class="shadow-sm border-end min-vh-100 py-4" style="background: linear-gradient(180deg, #ff7e5f, #feb47b);">
        <div class="text-center mb-4">
            <a href="{{ route('frontend.index') }}" class="text-white fs-3 fw-bold text-decoration-none">
                <i class="bi bi-speedometer2 me-2"></i> Mega<span class="text-warning">kit</span>
            </a>
        </div>

        <ul class="nav flex-column px-3">
            <li class="nav-item mb-2">
                <a href="{{ route('frontend.index') }}" class="nav-link sidebar-link {{ request()->routeIs('frontend.index') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill me-2 fs-5"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('frontend.categories') }}" class="nav-link sidebar-link {{ request()->routeIs('frontend.categories') ? 'active' : '' }}">
                    <i class="bi bi-folder-fill me-2 fs-5"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('frontend.tags') }}" class="nav-link sidebar-link {{ request()->routeIs('frontend.tags') ? 'active' : '' }}">
                    <i class="bi bi-tag-fill me-2 fs-5"></i>
                    <span>Tags</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link sidebar-link">
                    <i class="bi bi-telephone-fill me-2 fs-5"></i>
                    <span>Contact</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
.sidebar-link {
    /* display: flex;
    align-items: center; */
    color: #fff;
    background-color: transparent;
 transition: all 0.3s ease;
    border-radius: 8px; 
}

.sidebar-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #ffe9d6;
    text-decoration: none;
    transform: translateX(4px);
}

.sidebar-link.active {
    background-color: rgba(255, 255, 255, 0.2);
    font-weight: bold;
    color: #fff;
}
</style>