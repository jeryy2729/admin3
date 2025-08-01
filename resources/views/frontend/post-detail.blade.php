@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
<!-- 
<x-breadcrumbs :items="[
        'Categories' => route('frontend.categories'),
   $post->name => route('frontend.post-detail', $post)
]" /> -->
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


            {{-- ✅ Left Sidebar --}}
            <div class="col-md-3 border-end bg-light px-4 py-4">
                <div class="sticky-top" style="top: 80px">
                    <h5 class="mb-3 border-bottom pb-2 fw-bold text-primary">📁 Categories</h5>
                    <ul class="list-unstyled mb-4">
                        @foreach($categories as $cat)
                            <li class="mb-2">
                                <a href="#" class="d-block px-3 py-2 rounded text-dark hover-effect fw-semibold">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h5 class="mb-3 border-bottom pb-2 fw-bold text-primary">🏷️ Tags</h5>
                    <ul class="list-unstyled">
                        @foreach($tags as $tag)
                            <li class="mb-2">
                                <a href="#" class="d-block px-3 py-2 rounded text-dark hover-effect fw-semibold">
                                    {{ $tag->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ✅ Right Main Content --}}
            <div class="col-md-9 px-4 py-5 bg-white">
                {{-- Post Card --}}
                <div class="card border-0 shadow rounded-4 overflow-hidden">
                    @if($post->image)
                        <div class="post-bg-img" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                    @endif

                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-3 text-primary">{{ $post->name }}</h2>

                        {{-- Category --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark">📂 Category</h6>
                            <p class="mb-0 text-muted">{{ $post->category->name }}</p>
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark">📄 Description</h6>
                            <p class="text-secondary">{!! $post->description !!}</p>
                        </div>

                        {{-- Tags --}}
                        @if($post->tags->count())
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark">🏷️ Tags</h6>
                                @foreach($post->tags as $tag)
                                    <span class="badge rounded-pill bg-info text-dark me-1 mb-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Status --}}
                        <div class="mb-2">
                            <h6 class="fw-bold text-dark">📌 Status</h6>
                            <span class="badge {{ $post->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $post->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
{{-- ✅ Comments Section --}}
<div class="mt-5">
    <h4 class="fw-bold mb-4 text-primary border-bottom pb-2">💬 Comments</h4>

    @php
        $topLevelComments = $post->comments->whereNull('parent_id');
    @endphp

    @forelse($topLevelComments as $comment)
        <div class="border-start border-4 border-primary ps-3 mb-4">
            <div class="d-flex align-items-start gap-3">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-weight: 600;">
                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="text-dark">{{ $comment->user->name }}</strong>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-2 text-secondary small">{{ $comment->comment }}</p>

                    {{-- Replies --}}
                    @foreach ($comment->replies as $reply)
                        <div class="bg-light border-start border-3 border-info ps-3 py-2 ms-3 mb-2 rounded small">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-dark">{{ $reply->user->name }}</strong>
                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0 text-secondary">{{ $reply->comment }}</p>
                        </div>
                    @endforeach

                    {{-- Reply Form (only for other users) --}}
                    @auth
                        @if(auth()->id() !== $comment->user_id)
                            <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="mt-2 ms-3">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="mb-2">
                                    <textarea name="comment" rows="2" class="form-control form-control-sm" placeholder="Reply..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3">Reply</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No comments yet. Be the first to comment!</p>
    @endforelse

    {{-- ✅ Top-Level Comment Form --}}
    <hr class="my-4">

    @auth
        <form action="{{ route('comments.store') }}" method="POST" class="bg-light border rounded-4 p-4 shadow-sm">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-3">
                <label for="comment" class="form-label fw-semibold text-dark">Write a Comment</label>
                <textarea name="comment" id="comment" rows="3" class="form-control rounded-3" placeholder="Share your thoughts..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill px-4">💬 Post Comment</button>
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

{{-- Styles --}}
<style>
    .hover-effect:hover {
        background-color: #f8f9fa;
        text-decoration: none;
        color: #f96d41;
    }

    .post-bg-img {
        height: 280px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }
    
</style>
@endsection
