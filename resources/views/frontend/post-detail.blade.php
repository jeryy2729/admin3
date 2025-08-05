@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper py-4">
    <div class="container">
        <div class="row g-4">
            {{-- ✅ Breadcrumbs --}}
            <div class="col-12">
                @if($from === 'category' && $post->category)
                    <x-breadcrumbs :items="[
                        'Categories' => route('frontend.categories'),
                        $category->name => route('frontend.posts.show', $category->slug),
                        $post->name => ''
                    ]" />
                @elseif($from === 'tag' && $tag)
                    <x-breadcrumbs :items="[
                        'Tags' => route('frontend.tags'),
                        $tag->name => route('frontend.tag-post', $tag->slug),
                        $post->name => ''
                    ]" />
                @else
                    <x-breadcrumbs :items="[
                        $post->name => ''
                    ]" />
                @endif
            </div>

            {{-- ✅ Sidebar --}}
            <div class="col-md-3">
                <div class="p-4 bg-light border rounded sticky-top" style="top: 80px">
                    <h5 class="text-primary fw-bold mb-3"><i class="bi bi-folder-fill me-2"></i>Categories</h5>
                    <ul class="list-unstyled">
                        @foreach($categories as $cat)
                            <li class="mb-2">
                                <a href="#" class="d-block px-3 py-2 rounded text-dark hover-effect fw-semibold">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <h5 class="text-primary fw-bold mt-4 mb-3"><i class="bi bi-tags-fill me-2"></i>Tags</h5>
                    <ul class="list-unstyled">
                        @foreach($tags as $tag)
                            <li class="mb-2">
                                <a href="#" class="d-block px-3 py-2 rounded text-dark hover-effect fw-semibold">{{ $tag->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ✅ Main Content --}}
            <div class="col-md-9">
                <a href="{{ route('frontend.post.products', $post) }}" class="btn btn-outline-primary mb-4">
                    <i class="bi bi-box-seam me-2"></i> View Related Products
                </a>

                {{-- ✅ Post Card --}}
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    @if($post->image)
                        <div class="post-bg-img" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                    @endif

                    <div class="card-body p-5">
                        <h2 class="text-primary fw-bold mb-4">{{ $post->name }}</h2>

                        <div class="mb-3">
                            <h6 class="fw-bold text-dark"><i class="bi bi-folder2-open me-2"></i>Category</h6>
                            <p class="text-muted mb-0">{{ $post->category->name }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold text-dark"><i class="bi bi-file-text me-2"></i>Description</h6>
                            <p class="text-secondary">{!! $post->description !!}</p>
                        </div>

                        @if($post->tags->count())
                            <div class="mb-3">
                                <h6 class="fw-bold text-dark"><i class="bi bi-tags me-2"></i>Tags</h6>
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-info text-dark rounded-pill me-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div>
                            <h6 class="fw-bold text-dark"><i class="bi bi-circle-half me-2"></i>Status</h6>
                            <span class="badge {{ $post->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $post->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- ✅ Comments Section --}}
                <div class="mt-5">
                    <h4 class="fw-bold text-primary mb-4 border-bottom pb-2"><i class="bi bi-chat-left-text-fill me-2"></i>Comments</h4>

                    @php $topLevelComments = $post->comments->whereNull('parent_id'); @endphp

                    @forelse($topLevelComments as $comment)
                        <div class="border-start border-4 border-primary ps-3 mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width: 36px; height: 36px;">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="text-secondary small mb-2">{{ $comment->comment }}</p>

                                    {{-- Replies --}}
                                    @foreach ($comment->replies as $reply)
                                        <div class="bg-light border-start border-3 border-info ps-3 py-2 ms-3 mb-2 rounded small">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $reply->user->name }}</strong>
                                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0 text-secondary">{{ $reply->comment }}</p>
                                        </div>
                                    @endforeach

                                    {{-- Reply form --}}
                                    @auth
                                        @if(auth()->id() !== $comment->user_id)
                                            <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="mt-2 ms-3">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <textarea name="comment" rows="2" class="form-control form-control-sm mb-2" placeholder="Reply..." required></textarea>
                                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">Reply</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endforelse

                    {{-- Top Level Comment Form --}}
                    <hr class="my-4">

                    @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="bg-light border rounded-4 p-4 shadow-sm">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Write a Comment</label>
                                <textarea name="comment" class="form-control" rows="3" placeholder="Share your thoughts..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-chat-dots me-2"></i>Post Comment</button>
                        </form>
                    @else
                        <p class="mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-underline">Login</a> to write a comment.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ✅ Styles --}}
<style>
    .hover-effect:hover {
        background-color: #f1f1f1;
        color: #0d6efd;
        text-decoration: none;
    }

    .post-bg-img {
        height: 280px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
@endsection
