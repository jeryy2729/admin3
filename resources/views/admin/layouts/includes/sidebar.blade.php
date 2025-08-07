<h5 class="mb-4 text-uppercase fw-bold" style="color: #f96d41;">Admin Menu</h5>

<ul class="nav flex-column admin-sidebar">
    @auth('admin')
            <li class="nav-item mb-2">
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <i class="fas fa-list-alt me-2"></i> Categories
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('tags.index') }}" class="nav-link">
                    <i class="fas fa-tags me-2"></i> Tags
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('posts.index') }}" class="nav-link">
                    <i class="fa-solid fa-file-lines me-2"></i> Posts
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="fas fa-users me-2"></i> Users
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('comments.index') }}" class="nav-link">
                    <i class="fas fa-comments me-2"></i> Comments
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="fas fa-key me-2"></i> Permissions
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="fas fa-user-shield me-2"></i> Roles
                </a>
            </li>
           <li class="nav-item mb-2">
    <a href="{{ route('products.index') }}" class="nav-link">
        <i class="fas fa-box-open me-2"></i> Products
    </a>
</li>

<li class="nav-item mb-2">
    <a href="{{ route('orders.index') }}" class="nav-link">
        <i class="fas fa-shopping-cart me-2"></i> Orders
    </a>
</li>

 @endauth
 @auth

    <li class="nav-item mb-2">
                <a href="{{ route('posts.index') }}" class="nav-link">
                    <i class="fa-solid fa-file-lines me-2"></i> Posts
                </a>
            </li>
            
    
            @endauth
</ul>
