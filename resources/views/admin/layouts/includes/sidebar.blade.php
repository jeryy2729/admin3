<h5 class="mb-4 text-uppercase fw-bold" style="color: #f96d41;">Admin Menu</h5>

<ul class="nav flex-column admin-sidebar">
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
</ul>
<style>
.admin-sidebar .nav-link {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 10px 15px;
    color: #343a40;
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.admin-sidebar .nav-link:hover {
    background: linear-gradient(135deg, #f96d41, #f9a041);
    color: #fff;
    text-decoration: none;
}

.admin-sidebar .nav-link i {
    font-size: 1rem;
    color: inherit;
}
</style>
