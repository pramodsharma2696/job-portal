<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPost;
use Livewire\Component;
use App\Helper\ResponseHelper;
use App\Livewire\Pages\ToastComponent;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    
    public function deleteJob($jobId)
    {
        
        $job = JobPost::findOrFail($jobId);
        $this->authorize('delete', $job);
        // Delete associated company logo if exists
        if ($job->company_logo) {
            ResponseHelper::deleteImage($job->company_logo);
        }
        // Detach all skills 
        $job->skills()->detach();
    
        $job->delete();
        $this->dispatch('showToast', message: 'Job deleted successfully',type: 'success')->to(ToastComponent::class);
    }

    public function render()
    {
        $jobs = JobPost::with('skills')
            ->latest()
            ->get()
            ->map(function ($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'description' => $job->description,
                    'company_name' => $job->company_name,
                    'company_logo' => $job->company_logo,
                    'experience' => $job->experience,
                    'salary' => $job->salary,
                    'location' => $job->location,
                    'skills' => $job->skills->pluck('title')->toArray(),
                    'extra' => explode(',',$job->extra_info)
                ];
            });
        return view('livewire.pages.jobs.index', [
            'jobs' => $jobs
        ]);
    }
}