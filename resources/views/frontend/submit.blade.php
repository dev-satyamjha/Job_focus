@extends('layouts.frontend')

@section('content')
<div class="container my-5" style="max-width: 800px;">
    <div class="card shadow-sm border-0 border-top border-success border-4">
        <div class="card-body p-5">
            <h2 class="fw-bold text-success mb-4">Submit a Post</h2>
            <p class="text-muted mb-4">Submit a job, exam update, or article. It will be reviewed by our team before going live.</p>

            <form action="{{ route('frontend.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Content</label>
                    <textarea name="content" class="form-control" rows="5" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Cover Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-success px-5 py-2 fw-bold">Submit for Review</button>
            </form>
        </div>
    </div>
</div>
@endsection
