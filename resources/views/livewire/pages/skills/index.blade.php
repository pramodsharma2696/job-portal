<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Skills</h1>
      <p class="mt-2 text-sm text-gray-600">Manage your skill set</p>
    </div>
    <livewire:pages.toast-component />
    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Table Section (Left) -->
      <div class="lg:w-2/3">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skill</th>
                  <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($skills as $index => $skill)
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $skills->firstItem() + $index }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $skill->title }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                    <button wire:click="edit({{ $skill->id }})" class="text-indigo-600 hover:text-indigo-900">
                      <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                      </svg>
                    </button>
                    <button wire:click="delete({{ $skill->id }})" class="text-red-600 hover:text-red-900">
                      <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                      </svg>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $skills->links() }}
          </div>
        </div>
      </div>

      <!-- Form Section (Right) -->
      <div class="lg:w-1/3">
        <div class="bg-white shadow sm:rounded-lg p-6">
          <h2 class="text-lg font-medium text-gray-900 mb-4">
            {{ $skillId ? 'Edit Skill' : 'Add New Skill' }}
          </h2>
          <form wire:submit.prevent="{{ $skillId ? 'update' : 'store' }}">
            <div class="mb-4">
           
              <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input type="text" wire:model="title" id="title" 
                     class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                     placeholder="e.g. Laravel, Vue.js">
              @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="flex space-x-3">
              <button type="submit" 
                      class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ $skillId ? 'Update' : 'Add Skill' }}
              </button>
              @if ($skillId)
              <button type="button" wire:click="cancelEdit" 
                      class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
              </button>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>