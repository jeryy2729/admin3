<h5 class="mb-4 text-uppercase" style="color: #f96d41;">Admin Menu</h5>
<ul class="nav flex-column">
    <li class="nav-item">
        <a href="{{ route('categories.index') }}" class="nav-link text-dark">
            <i class="fas fa-list-alt me-1"></i> Categories
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('tags.index') }}" class="nav-link text-dark">
            <i class="fas fa-tags me-1"></i> Tags
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('posts.index') }}" class="nav-link text-dark">
            <i class="fa-solid fa-file-lines me-1"></i> Post
        </a>
    </li>
     <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link text-dark">
            <i class="fas fa-users me-1"></i> Users
        </a>
    </li>
     <li class="nav-item">
        <a href="{{ route('comments.index') }}" class="nav-link text-dark">
            <i class="fas fa-comments me-1"></i> Comments
        </a>
    </li>
</ul>
