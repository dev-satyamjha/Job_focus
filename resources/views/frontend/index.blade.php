@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row mb-4 p-3 bg-white rounded shadow-sm g-3">
        <div class="col-md-4">
            <input type="text" id="search-input" class="form-control" placeholder="Search by title...">
        </div>
        <div class="col-md-4">
            <select id="category-filter" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="date" id="date-filter" class="form-control">
        </div>
    </div>

    <div class="row" id="blog-container">
        @include('frontend.partials.blog-list')
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function fetchFilteredBlogs() {
        let category = $('#category-filter').val();
        let date = $('#date-filter').val();
        let search = $('#search-input').val();

        $('#blog-container').css('opacity', '0.5');

        $.ajax({
            url: "{{ route('blogs.filter') }}",
            type: "GET",
            data: {
                category: category,
                date: date,
                search: search
            },
            success: function(response) {
                $('#blog-container').html(response).css('opacity', '1');
            },
            error: function() {
                $('#blog-container').css('opacity', '1');
                alert('Failed to load matching blog data elements.');
            }
        });
    }

    $('#category-filter, #date-filter').on('change', fetchFilteredBlogs);
    $('#search-input').on('keyup', fetchFilteredBlogs);
});
</script>
@endsection
