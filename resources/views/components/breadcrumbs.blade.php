@props(['items' => []])

<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-white px-3 py-2 rounded shadow-sm">
        <li class="breadcrumb-item">
            <a href="{{ route('frontend.index') }}" class="text-decoration-none text-primary">{{__('messages.home')}}</a>
        </li>

        @foreach ($items as $label => $url)
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $url }}" class="text-decoration-none text-primary">{{ $label }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
