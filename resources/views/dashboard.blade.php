<x-app-layout>
    @section('header', 'Dashboard Overview')

    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Projects Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Projects</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalProjects }}</p>
                    </div>
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-gray-500">
                    <span class="text-emerald-600 font-semibold mr-1">{{ $activeProjects }} active</span> · {{ $completedProjects }} completed
                </div>
            </div>

            <!-- Total Tasks Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">My Tasks</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalTasks }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-gray-500">
                    <span class="text-blue-600 font-semibold mr-1">{{ $inProgressTasks }} in progress</span> · {{ $completedTasks }} done
                </div>
            </div>

            <!-- Pending Tasks Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pending Tasks</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $pendingTasks }}</p>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-gray-500">
                    Awaiting action or start
                </div>
            </div>

            <!-- Overdue Tasks Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Overdue Tasks</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">{{ $overdueTasks }}</p>
                    </div>
                    <div class="p-3 bg-red-50 text-red-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-gray-500">
                    Requires immediate attention
                </div>
            </div>
        </div>

        <!-- Recent Projects & Tasks Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Projects -->
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Recent Projects</h3>
                <div class="divide-y divide-gray-100">
                    @forelse($recentProjects as $project)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $project->name }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $project->status }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ optional($project->due_date)->format('M d, Y') }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 py-4">No projects created yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Tasks -->
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Recent Tasks</h3>
                <div class="divide-y divide-gray-100">
                    @forelse($recentTasks as $task)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $task->title }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $task->status }} · Priority: {{ $task->priority }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ optional($task->due_date)->format('M d, Y') }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 py-4">No tasks assigned or created yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>