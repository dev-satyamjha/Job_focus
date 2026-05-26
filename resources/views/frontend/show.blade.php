@extends('layouts.frontend')

@section('content')
<div class="container bg-white p-4 p-md-5 rounded shadow-sm my-4" style="max-width: 800px;">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}" class="text-decoration-none text-dark">Home</a></li>
            <li class="breadcrumb-item active">{{ $blog->category->name ?? 'Uncategorized' }}</li>
        </ol>
    </nav>

    <h1 class="mb-3 fw-bold" style="color: #1b1b18;">{{ $blog->title }}</h1>
    <div class="d-flex flex-wrap gap-2 mb-4 align-items-center">
        <span class="badge bg-primary">{{ $blog->category->name ?? 'Uncategorized' }}</span>
        <span class="text-muted small">Posted on {{ $blog->published_date->format('F d, Y') }}</span>
    </div>

    @if($blog->image)
        <img src="{{ asset($blog->image) }}" class="img-fluid rounded mb-4 w-100 shadow-sm" alt="{{ $blog->title }}" style="max-height: 450px; object-fit: cover;">
    @endif

    @if($blog->experience_level || $blog->work_model || $blog->job_type || $blog->sector || $blog->tech_stack || $blog->application_deadline)
        <div class="card border-0 bg-light mb-5 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Job & Update Details</h5>

                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @if($blog->job_type)
                        <div class="col"><strong>Job Type:</strong> <span class="text-muted">{{ $blog->job_type }}</span></div>
                    @endif
                    @if($blog->work_model)
                        <div class="col"><strong>Work Model:</strong> <span class="text-muted">{{ $blog->work_model }}</span></div>
                    @endif
                    @if($blog->experience_level)
                        <div class="col"><strong>Experience:</strong> <span class="text-muted">{{ $blog->experience_level }}</span></div>
                    @endif
                    @if($blog->sector)
                        <div class="col"><strong>Sector:</strong> <span class="text-muted">{{ $blog->sector }}</span></div>
                    @endif
                    @if($blog->application_deadline)
                        <div class="col">
                            <strong>Deadline:</strong>
                            <span class="{{ $blog->application_deadline->isPast() ? 'text-danger fw-bold' : 'text-success fw-bold' }}">
                                {{ $blog->application_deadline->format('F d, Y') }}
                            </span>
                        </div>
                    @endif
                </div>

                @if($blog->tech_stack)
                    <div class="mt-3 pt-3 border-top">
                        <strong>Tech Stack / Skills:</strong>
                        <div class="mt-2">
                            @foreach(explode(',', $blog->tech_stack) as $tech)
                                @if(trim($tech) != '')
                                    <span class="badge bg-secondary me-1 mb-1">{{ trim($tech) }}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="blog-content fs-5 text-dark" style="line-height: 1.8;">
        {!! nl2br(e($blog->content)) !!}
    </div>

    <div class="mt-5 text-center border-top pt-4">
        <a href="{{ route('frontend.index') }}" class="btn btn-outline-dark px-4">&larr; Back to Listings</a>
    </div>
</div>
@endsection
