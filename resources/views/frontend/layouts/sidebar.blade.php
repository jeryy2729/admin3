<div class="col-md-3 px-0 d-none d-md-block">
    <div class="min-vh-100 py-4" style="background: linear-gradient(180deg, #942c8c, #d10710); box-shadow: inset 0 0 15px rgba(0,0,0,0.2);">
        <div class="text-center mb-4">
            <a href="{{ route('frontend.index') }}" class="text-white fs-3 fw-bold text-decoration-none">
                <i class="bi bi-speedometer2 me-2"></i> Mega<span class="text-warning">kit</span>
            </a>
        </div>

        <ul class="nav flex-column px-3">
            <li class="nav-item mb-3">
                <a href="{{ route('frontend.index') }}" class="nav-link sidebar-link {{ request()->routeIs('frontend.index') ? 'active' : '' }}">
                    <i class="bi bi-house-fill me-2 fs-5"></i>
    {{ __('messages.home') }}
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('frontend.categories') }}" class="nav-link sidebar-link {{ request()->routeIs('frontend.categories') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill me-2 fs-5"></i>
    {{ __('messages.category') }}
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('frontend.tags') }}" class="nav-link sidebar-link {{ request()->routeIs('frontend.tags') ? 'active' : '' }}">
                    <i class="bi bi-tags-fill me-2 fs-5"></i>
                {{ __('messages.tag') }}

                </a>
            </li>
             <li class="nav-item mb-3">
                <a href="{{ route('cart.index') }}" class="nav-link sidebar-link {{ request()->routeIs('cart.index') ? 'active' : '' }}">
<i class="bi bi-cart-fill me-2 fs-5"></i>
    {{ __('messages.cart') }}
                </a>
            </li><li class="nav-item mb-3">
                <a href="{{ route('orders.history') }}" class="nav-link sidebar-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
        <i class="bi bi-clock-history me-2 fs-5"></i>    {{ __('messages.history') }}

    </a>
</li>


            <li class="nav-item mb-3">
                <a href="#" class="nav-link sidebar-link">
                    <i class="bi bi-envelope-fill me-2 fs-5"></i>
                    Contact
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
.sidebar-link {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 10px 15px;
    font-weight: 500;
    transition: all 0.3s ease-in-out;
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.sidebar-link:hover {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    transform: translateX(5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

.sidebar-link.active {
    background-color: rgba(255, 255, 255, 0.3);
    color: #fff;
    font-weight: 600;
    box-shadow: inset 0 0 8px rgba(255, 255, 255, 0.3);
}

.nav-item {
    transition: transform 0.2s ease-in-out;
}

.nav-item:hover {
    transform: scale(1.03);
}
</style>
