<x-app-layout>
    @section('header', 'Create New Project')

    <div class="max-w-xl bg-white shadow-sm rounded-xl border border-gray-100 p-6">
        <form method="POST" action="{{ route('projects.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Project Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="planning">Planning</option>
                    <option value="active">Active</option>
                    <option value="on_hold">On Hold</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                @error('status') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date') }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('projects.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Create Project</button>
            </div>
        </form>
    </div>
</x-app-layout>