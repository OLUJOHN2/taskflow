<x-app-layout>
    @section('header', 'My Projects')

    <div class="space-y-6">
        <!-- Actions bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('projects.index') }}" class="flex items-center space-x-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search projects..." class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                <select name="status" class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Statuses</option>
                    <option value="planning" {{ request('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="on_hold" {{ request('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Filter</button>
            </form>

            <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                + New Project
            </a>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($projects as $project)
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                @if($project->status == 'active') bg-emerald-50 text-emerald-700 
                                @elseif($project->status == 'planning') bg-blue-50 text-blue-700 
                                @elseif($project->status == 'on_hold') bg-amber-50 text-amber-700 
                                @elseif($project->status == 'completed') bg-purple-50 text-purple-700 
                                @else bg-gray-50 text-gray-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                            <span class="text-xs text-gray-400">Due: {{ optional($project->due_date)->format('M d, Y') ?? 'N/A' }}</span>
                        </div>
                        <h4 class="text-base font-semibold text-gray-900 mb-1">
                            <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600">{{ $project->name }}</a>
                        </h4>
                        <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $project->description ?? 'No description provided.' }}</p>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 text-sm">
                        <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 font-medium hover:underline">View details &rarr;</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-gray-100">
                    <p class="text-sm text-gray-500">No projects found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div>
            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>