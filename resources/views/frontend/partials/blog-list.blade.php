@forelse($blogs as $blog)
    <div class="col-md-4 mb-4 blog-card-item">
        <div class="card h-100 shadow-sm">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">No Image</div>
            @endif
            <div class="card-body">
                <span class="badge bg-primary mb-2">{{ $blog->category->name }}</span>
                <h5 class="card-title">{{ $blog->title }}</h5>
                <p class="card-text text-muted small">{{ $blog->short_description }}</p>
            </div>
            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                <small class="text-muted">{{ $blog->published_date->format('M d, Y') }}</small>
                <a href="{{ route('frontend.show', $blog->slug) }}" class="btn btn-sm btn-outline-dark">Read More</a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center my-5">
        <p class="text-muted fs-5">No matching blogs found.</p>
    </div>
@endforelse
