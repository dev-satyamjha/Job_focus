<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Blog</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Category / Sector</label>
                        <select name="category_id" class="w-full border-gray-300 rounded" required>
                            <option value="">Select a Category or Sector</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Short Description</label>
                        <textarea name="short_description" class="w-full border-gray-300 rounded" rows="2" required>{{ old('short_description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                        <textarea name="content" class="w-full border-gray-300 rounded" rows="6" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                        <input type="file" name="image" class="w-full border-gray-300 rounded" accept="image/*">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Experience Level</label>
                            <select name="experience_level" class="w-full border-gray-300 rounded">
                                <option value="">Not Specified</option>
                                <option value="Fresher" {{ old('experience_level') == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                                <option value="1-3 Years" {{ old('experience_level') == '1-3 Years' ? 'selected' : '' }}>1-3 Years</option>
                                <option value="3-5 Years" {{ old('experience_level') == '3-5 Years' ? 'selected' : '' }}>3-5 Years</option>
                                <option value="5+ Years" {{ old('experience_level') == '5+ Years' ? 'selected' : '' }}>5+ Years</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Work Model</label>
                            <select name="work_model" class="w-full border-gray-300 rounded">
                                <option value="">Not Specified</option>
                                <option value="Remote" {{ old('work_model') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                <option value="Hybrid" {{ old('work_model') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="On-site" {{ old('work_model') == 'On-site' ? 'selected' : '' }}>On-site</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Job Type</label>
                            <select name="job_type" class="w-full border-gray-300 rounded">
                                <option value="">Not Specified</option>
                                <option value="Full-time" {{ old('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Contract" {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Application Deadline</label>
                            <input type="date" name="application_deadline" value="{{ old('application_deadline') }}" class="w-full border-gray-300 rounded">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tech Stack (comma separated)</label>
                            <input type="text" name="tech_stack" value="{{ old('tech_stack') }}" class="w-full border-gray-300 rounded" placeholder="e.g. React, Node.js, AWS">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Published Date</label>
                        <input type="date" name="published_date" value="{{ old('published_date', now()->format('Y-m-d')) }}" class="w-full border-gray-300 rounded" required>
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save Blog</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
