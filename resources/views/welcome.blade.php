@extends('layouts.frontend')

@section('content')
<div class="container my-5">

    <div class="row mb-4 text-center">
        <div class="col-12">
            <h1 class="fw-bold">Job Focus</h1>
            <p class="text-muted">Latest updates, articles, and job postings.</p>
        </div>
    </div>

    <div class="row mb-5 justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('blogs.filter') }}" method="GET" class="d-flex gap-2 bg-light p-3 rounded shadow-sm border">

                <input type="text" name="search" class="form-control border-0" placeholder="Search keywords..." value="{{ request('search') }}">

                <select name="category" class="form-select border-0" style="max-width: 200px;">
                    <option value="">All Categories</option>
                    @isset($categories)
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endisset
                </select>

                <button type="submit" class="btn btn-dark px-4">Filter</button>

                @if(request()->has('search') || request()->has('category'))
                    <a href="{{ route('frontend.index') }}" class="btn btn-outline-danger">Clear</a>
                @endif
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($blogs as $blog)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">

                    @if($blog->image)
                        <img src="{{ asset($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 220px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 220px;">
                            No Image
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($blog->short_description, 100) }}</p>

                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                            <small class="text-muted">{{ $blog->published_date->format('M d, Y') }}</small>
                            <a href="{{ route('frontend.show', $blog->slug) }}" class="btn btn-sm btn-outline-dark">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">No posts found. Please try a different search or check back later!</h4>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->links() ?? '' }}
    </div>
</div>
@endsection
