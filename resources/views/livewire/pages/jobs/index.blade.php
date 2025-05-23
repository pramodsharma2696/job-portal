<!-- resources/views/livewire/pages/jobs/index.blade.php -->
<div>
    <div class="container mx-auto py-4">
        <!-- <div class="flex justify-between items-center py-8">
            <h1 class="text-2xl font-bold">Jobs</h1>
            <a href="{{ route('admin.jobs.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors">
                Create New Job
            </a>
        </div> -->
        <livewire:pages.toast-component />
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Title</th>
                                <th scope="col" class="px-4 py-3">Description</th>
                                <th scope="col" class="px-4 py-3">Company Logo</th>
                                <th scope="col" class="px-4 py-3">Company Name</th>
                                <th scope="col" class="px-4 py-3">Experience</th>
                                <th scope="col" class="px-4 py-3">Salary</th>
                                <th scope="col" class="px-4 py-3">Location</th>
                                <th scope="col" class="px-4 py-3">Skills</th>
                                <th scope="col" class="px-4 py-3">Extra</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobs as $job)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $job['title'] }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ Str::limit($job['description'] ?? '', 30) }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset($job['company_logo']) ?? '' }}"
                                            class="h-10 w-10 rounded-full object-cover"
                                            alt="{{ $job['company_name'] ?? '' }}">
                                        
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $job['company_name'] ?? '' }}</td>
                                <td class="px-4 py-3">{{ $job['experience'] ?? '' }}</td>
                                <td class="px-4 py-3">{{ $job['salary'] ?? '' }}</td>
                                <td class="px-4 py-3">{{ $job['location'] ?? '' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1 max-w-[200px]">
                                        @foreach ($job['skills'] ?? [] as $skill)
                                        <span class="inline-block bg-blue-100 rounded-full px-2 py-0.5 text-xs font-medium text-blue-800">
                                            {{ $skill }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($job['extra'] ?? [] as $extra)
                                        <span class="inline-block bg-amber-100 rounded-full px-2 py-0.5 text-xs font-medium text-amber-800">
                                            {{ $extra }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        @can('update', $job)
                                        <a href="{{ route('admin.edit', $job['id']) }}"
                                            class="text-sm px-2 py-1 rounded hover:bg-slate-100 transition-colors text-blue-500">
                                            Edit
                                        </a>
                                        @endcan
                                        @can('delete', $job)
                                        <button wire:click.prevent="deleteJob({{ $job['id'] }})"
                                        class="text-sm px-2 py-1 rounded hover:bg-slate-100 transition-colors text-red-500">
                                    <span wire:loading.remove>Delete</span>
                                    <span wire:loading>Deleting...</span>
                                </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-4 py-6 text-center text-gray-500">
                                    No jobs found. Create your first job posting!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>