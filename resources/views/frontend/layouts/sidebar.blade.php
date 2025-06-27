<!-- frontend/layouts/sidebar.blade.php -->
<div class="col-md-3 px-0"> {{-- Removed side padding --}}
    <div class="bg-white p-4 rounded-0 border-end min-vh-100 shadow-sm">
        <h5 class="mb-4 border-bottom pb-2">Quick Links</h5>
        <ul class="list-unstyled mb-0">
            <li class="mb-2">
                <a href="{{ url('/front') }}" class="d-block px-2 py-1 rounded text-dark text-decoration-none hover-effect">🏠 Home</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('frontend.post') }}" class="d-block px-2 py-1 rounded text-dark text-decoration-none hover-effect">📝 Posts</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('frontend.categories') }}" class="d-block px-2 py-1 rounded text-dark text-decoration-none hover-effect">📁 Categories</a>
            </li>
             <li class="mb-2">
                <a href="{{ route('frontend.tags') }}" class="d-block px-2 py-1 rounded text-dark text-decoration-none hover-effect">🏷️ Tags</a>
            </li>
           
            <li>
                <a href="#" class="d-block px-2 py-1 rounded text-dark text-decoration-none hover-effect">📞 Contact</a>
            </li>
        </ul>
    </div>
</div>
