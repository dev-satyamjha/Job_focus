<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Blog Management</h2>
            <a href="{{ route('admin.blogs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Blog</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b py-2 px-4">Title</th>
                            <th class="border-b py-2 px-4">Category</th>
                            <th class="border-b py-2 px-4">Date</th>
                            <th class="border-b py-2 px-4">Status</th>
                            <th class="border-b py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td class="border-b py-2 px-4">{{ $blog->title }}</td>
                                <td class="border-b py-2 px-4">{{ $blog->category->name }}</td>
                                <td class="border-b py-2 px-4">{{ $blog->published_date->format('Y-m-d') }}</td>
                                <td class="border-b py-2 px-4">
                                    @if($blog->is_approved)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @endif
                                </td>
                                <td class="border-b py-2 px-4 flex gap-2">
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                    <form action="{{ route('admin.blogs.toggle', $blog->id) }}" method="POST" class="inline-block mr-3">
                                        @csrf
                                        @method('PATCH')
                                        @if($blog->is_approved)
                                            <button type="submit" title="Revoke Approval" class="text-red-500 hover:text-red-700 font-bold text-lg">&#10006;</button>
                                        @else
                                            <button type="submit" title="Approve Post" class="text-green-500 hover:text-green-700 font-bold text-lg">&#10004;</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
