<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\Skill;
use App\Models\JobPost;
use Livewire\Component;
use App\Services\JobServices;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Pages\ToastComponent;
use App\Services\Interfaces\JobServicesInterface;


class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $experience;
    public $salary;
    public $location;
    public $extra_info;
    public $company_name;
    public $company_logo;
    public $selectedSkills = []; // Changed from skill_id to array

    
    protected JobServicesInterface $jobServices;

    public function boot(JobServicesInterface $jobServices)
    {
        $this->jobServices = $jobServices;
    }

    public function save()
    {
        $data = $this->validate(config('rules.job.create.rules'),config('rules.job.create.messages'));
        try {
            $this->authorize('create', JobPost::class);
            $this->jobServices->create($data, $this->company_logo);
            $this->resetFields();
            $this->dispatch('showToast', message: 'Job posted successfully',type: 'success')->to(ToastComponent::class);
            return redirect()->route('jobs.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create job: ' . $e->getMessage());
        }
    }

    private function resetFields()
    {
        $this->reset([
            'title',
            'description',
            'experience',
            'salary',
            'location',
            'extra_info',
            'company_name',
            'company_logo',
            'selectedSkills',
        ]);
    }

    public function render()
    {
        $skills = Skill::all();
        return view('livewire.pages.jobs.create', compact('skills'));
    }
}