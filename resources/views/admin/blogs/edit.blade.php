<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Blog</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Category / Sector</label>
                        <select name="category_id" class="w-full border-gray-300 rounded" required>
                            <option value="">Select a Category or Sector</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Short Description</label>
                        <textarea name="short_description" class="w-full border-gray-300 rounded" rows="2" required>{{ old('short_description', $blog->short_description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                        <textarea name="content" class="w-full border-gray-300 rounded" rows="6" required>{{ old('content', $blog->content) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Current Image</label>
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}" class="h-20 mb-2 rounded shadow-sm">
                        @endif
                        <input type="file" name="image" class="w-full border-gray-300 rounded" accept="image/*">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Experience Level</label>
                            <select name="experience_level" class="w-full border-gray-300 rounded">
                                <option value="">Not Specified</option>
                                <option value="Fresher" {{ old('experience_level', $blog->experience_level) == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                                <option value="1-3 Years" {{ old('experience_level', $blog->experience_level) == '1-3 Years' ? 'selected' : '' }}>1-3 Years</option>
                                <option value="3-5 Years" {{ old('experience_level', $blog->experience_level) == '3-5 Years' ? 'selected' : '' }}>3-5 Years</option>
                                <option value="5+ Years" {{ old('experience_level', $blog->experience_level) == '5+ Years' ? 'selected' : '' }}>5+ Years</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Work Model</label>
                            <select name="work_model" class="w-full border-gray-300 rounded">
                                <option value="">Not Specified</option>
                                <option value="Remote" {{ old('work_model', $blog->work_model) == 'Remote' ? 'selected' : '' }}>Remote</option>
                                <option value="Hybrid" {{ old('work_model', $blog->work_model) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="On-site" {{ old('work_model', $blog->work_model) == 'On-site' ? 'selected' : '' }}>On-site</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Job Type</label>
                            <select name="job_type" class="w-full border-gray-300 rounded">
                                <option value="">Not Specified</option>
                                <option value="Full-time" {{ old('job_type', $blog->job_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Internship" {{ old('job_type', $blog->job_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Contract" {{ old('job_type', $blog->job_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Application Deadline</label>
                            <input type="date" name="application_deadline" value="{{ old('application_deadline', $blog->application_deadline ? $blog->application_deadline->format('Y-m-d') : '') }}" class="w-full border-gray-300 rounded">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tech Stack (comma separated)</label>
                            <input type="text" name="tech_stack" value="{{ old('tech_stack', $blog->tech_stack) }}" class="w-full border-gray-300 rounded" placeholder="e.g. React, Node.js, AWS">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Published Date</label>
                        <input type="date" name="published_date" value="{{ old('published_date', $blog->published_date->format('Y-m-d')) }}" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-6 bg-gray-50 p-3 rounded border border-gray-200">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_approved" value="1" {{ old('is_approved', $blog->is_approved) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-5 w-5">
                            <span class="ml-3 text-gray-700 font-medium">Approve this post for public viewing</span>
                        </label>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">Update Blog</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
