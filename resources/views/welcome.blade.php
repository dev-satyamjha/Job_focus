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
        <div class="col-12">
            <form action="{{ route('blogs.filter') }}" method="GET" class="bg-light p-4 rounded shadow-sm border">

                <div class="row g-2 mb-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" placeholder="Search keywords or tech stack (e.g. Python, Laravel)..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="">All Categories & Sectors</option>

                            <optgroup label="Examination Hub">
                                @isset($categories)
                                    @foreach($categories as $category)
                                        @if(in_array(strtolower($category->name), ['admit card', 'result', 'results']))
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endisset
                            </optgroup>

                            <optgroup label="General Jobs & Sectors">
                                @isset($categories)
                                    @foreach($categories as $category)
                                        @if(!in_array(strtolower($category->name), ['admit card', 'result', 'results']))
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endisset
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-md-3">
                        <select name="experience_level" class="form-select text-sm">
                            <option value="">Any Experience</option>
                            <option value="Fresher" {{ request('experience_level') == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                            <option value="1-3 Years" {{ request('experience_level') == '1-3 Years' ? 'selected' : '' }}>1-3 Years</option>
                            <option value="3-5 Years" {{ request('experience_level') == '3-5 Years' ? 'selected' : '' }}>3-5 Years</option>
                            <option value="5+ Years" {{ request('experience_level') == '5+ Years' ? 'selected' : '' }}>5+ Years</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="work_model" class="form-select text-sm">
                            <option value="">Any Work Model</option>
                            <option value="Remote" {{ request('work_model') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Hybrid" {{ request('work_model') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="On-site" {{ request('work_model') == 'On-site' ? 'selected' : '' }}>On-site</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="job_type" class="form-select text-sm">
                            <option value="">Any Job Type</option>
                            <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                            <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="urgency" class="form-select text-sm">
                            <option value="">Any Urgency</option>
                            <option value="closing_soon" {{ request('urgency') == 'closing_soon' ? 'selected' : '' }}>Closing in 7 Days</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    @if(request()->anyFilled(['search', 'category', 'experience_level', 'work_model', 'job_type', 'urgency']))
                        <a href="{{ route('frontend.index') }}" class="btn btn-outline-danger px-4">Clear Filters</a>
                    @endif
                    <button type="submit" class="btn btn-success px-5">Search & Filter</button>
                </div>

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
                            <span class="badge bg-success">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                            @if($blog->experience_level)
                                <span class="badge bg-info text-dark">{{ $blog->experience_level }}</span>
                            @endif
                        </div>
                        <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($blog->short_description, 100) }}</p>

                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                            <small class="text-muted">{{ $blog->published_date->format('M d, Y') }}</small>
                            <a href="{{ route('frontend.show', $blog->slug) }}" class="btn btn-sm btn-outline-success">Read More</a>
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
