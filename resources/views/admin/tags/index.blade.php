@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">
<div class="mb-3 d-flex justify-content-end">
    <form action="{{ route('tags.export') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fas fa-file-export me-1"></i> Export Tags
        </button>
    </form>
</div>



                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0 text-primary fw-bold"><i class="fas fa-tags"></i> All Tags</h2>
                        <a class="btn btn-success" href="{{ route('tags.create') }}">
                            <i class="fas fa-plus-circle"></i> Add New Tag
                        </a>
                    </div>

                    <a href="{{ $showTrashed ? route('tags.index') : route('tags.index', ['trashed' => true]) }}" 
                       class="btn btn-outline-info mb-3">
                        <i class="fas fa-eye"></i> {{ $showTrashed ? 'Show Active' : 'Show Trashed' }}
                    </a>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="tags-table" class="table table-striped table-hover align-middle">
                            <thead class="table-gradient text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td class="fw-semibold">{{ $tag->name }}</td>
                                        <td>{!! \Illuminate\Support\Str::words($tag->description, 5) !!}</td>
                                        <td>
                                            @if($tag->status)
                                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Active</span>
                                            @else
                                                <span class="badge bg-secondary"><i class="fas fa-times-circle"></i> Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($showTrashed)
                                                <form action="{{ route('tags.restore', $tag) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Restore this tag?')">
                                                        <i class="fas fa-undo-alt"></i> Restore
                                                    </button>
                                                </form>

                                                <form action="{{ route('tags.forceDelete', $tag) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete this tag?')">
                                                        <i class="fas fa-trash"></i> Erase
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this tag?')">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>

                                                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning ms-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No tags found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
