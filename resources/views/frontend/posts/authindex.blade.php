@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
<x-breadcrumbs :items="[__('messages.post') => '']" />

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-5 bg-light">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-primary">📋 {{__('messages.my_posts')}}</h2>
                    <a href="{{ route('user.posts.create') }}" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-plus me-1"></i> {{__('messages.create_post')}}
                    </a>
                </div>

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif

                {{-- Posts Table --}}
                <div class="table-responsive border rounded shadow-sm">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary text-center">
                            <tr class="text-uppercase small fw-bold">
                                <th>#</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Tags</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $index => $post)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                                    <td class="fw-semibold text-primary">{{ $post->name }}</td>
                                    <td>
                                        @forelse($post->tags as $tag)
                                            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                                        @empty
                                            <span class="badge bg-light text-muted">No Tags</span>
                                        @endforelse
                                    </td>
                                    <td class="text-muted text-start">{{ \Illuminate\Support\Str::limit(strip_tags($post->description), 50) }}</td>
                                    <td>
                                        <span class="badge rounded-pill {{ $post->status ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $post->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill {{ $post->is_approved ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $post->is_approved ? 'Approved' : 'Pending' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No posts available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $posts->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
