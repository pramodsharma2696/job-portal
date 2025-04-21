<div>
    <div class="container mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Create New Job Posting</h1>
        </div>
        <livewire:pages.toast-component />
        <form wire:submit.prevent="save" class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <div class="flex flex-col md:flex-row">
                <!-- Left Section - Job Details -->
                <div class="w-full md:w-1/2 p-8 space-y-6 border-r border-gray-200">
                    <div class="pb-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Job Details</h2>
                        <p class="text-sm text-gray-500 mt-1">Fill in the job requirements and description</p>
                    </div>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title *</label>
                        <input wire:model="title" type="text" id="title" 
                               class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="e.g. Senior Laravel Developer">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Description *</label>
                        <textarea wire:model="description" id="description" rows="5"
                                  class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Describe the job responsibilities, requirements, and benefits"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Two fields in one row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Experience *</label>
                            <input wire:model="experience" type="text" id="experience" 
                                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="e.g. 1-5 years">
                            @error('experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary *</label>
                            <input wire:model="salary" type="text" id="salary" 
                                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="e.g. 2.5LPA - 15LPA">
                            @error('salary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Two fields in one row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                            <input wire:model="location" type="text" id="location" 
                                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="e.g. Remote, Pune, etc.">
                            @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="extra_info" class="block text-sm font-medium text-gray-700 mb-1">Extra Info</label>
                            <input wire:model="extra_info" type="text" id="extra_info" 
                                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="e.g Full Time, Urgent/Part Time, Flexible">
                                   <p class="mt-1 text-xs text-gray-500">Please use comma separated value</p>
                            @error('extra_info') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Section - Company Details -->
                <div class="w-full md:w-1/2 p-8 space-y-6 bg-gray-50">
                    <div class="pb-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Company Details</h2>
                        <p class="text-sm text-gray-500 mt-1">Tell us about your company</p>
                    </div>
                    
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                        <input wire:model="company_name" type="text" id="company_name" 
                               class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Your company name">
                        @error('company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="company_logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                        <div class="mt-1 flex items-center">
                            <label for="company_logo" class="cursor-pointer">
                                <span class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    Upload Logo
                                </span>
                                <input wire:model="company_logo" type="file" id="company_logo" class="sr-only">
                            </label>
                            @if($company_logo)
                                <span class="ml-4 text-sm text-gray-600">{{ $company_logo->getClientOriginalName() }}</span>
                            @endif
                        </div>
                        @error('company_logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @if($company_logo)
                            <div class="mt-2">
                                <img src="{{ $company_logo->temporaryUrl() }}" class="h-20 w-20 object-contain rounded-lg border border-gray-200">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Required Skills *</label>
                        <div class="mt-1 relative">
                            <select wire:model="selectedSkills" multiple
                                    class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg h-auto min-h-[42px]">
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" class="py-1">{{ $skill->title }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Hold Ctrl/Cmd to select multiple skills</p>
                        </div>
                        @error('selectedSkills') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        
                        @if(count($selectedSkills) > 0)
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach($selectedSkills as $skillId)
                                    @php $skill = $skills->firstWhere('id', $skillId); @endphp
                                    @if($skill)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            {{ $skill->title }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-100 text-right border-t border-gray-200">
                <button type="submit" 
                        class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Post Job
                </button>
            </div>
        </form>
    </div>
</div>