@extends('layouts.frontend')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm max-width-md my-4" style="max-width: 800px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $blog->category->name }}</li>
        </ol>
    </nav>

    <h1 class="mb-2 fw-bold">{{ $blog->title }}</h1>
    <div class="text-muted small mb-4">Published on {{ $blog->published_date->format('F d, Y') }}</div>

    @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid rounded mb-4 w-100" alt="{{ $blog->title }}" style="max-height: 450px; object-fit: cover;">
    @endif

    <div class="blog-content entry-textline-height fs-5">
        {!! nl2br(e($blog->content)) !!}
    </div>
</div>
@endsection
