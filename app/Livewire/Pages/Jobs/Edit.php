<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\Skill;
use App\Models\JobPost;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Pages\ToastComponent;
use App\Services\Interfaces\JobServicesInterface;

class Edit extends Component
{
    use WithFileUploads;

    public JobPost $job;
    public $title;
    public $description;
    public $experience;
    public $salary;
    public $location;
    public $extra_info;
    public $company_name;
    public $company_logo;
    public $new_company_logo;
    public $selectedSkills = [];

    public function mount(JobPost $job)
    {
        $this->job = $job;
        $this->title = $job->title;
        $this->description = $job->description;
        $this->experience = $job->experience;
        $this->salary = $job->salary;
        $this->location = $job->location;
        $this->extra_info = $job->extra_info;
        $this->company_name = $job->company_name;
        $this->company_logo = $job->company_logo;
        $this->selectedSkills = $job->skills->pluck('id')->toArray();
    }

    
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'experience' => 'required|string',
            'salary' => 'required|string',
            'location' => 'required|string',
            'extra_info' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'new_company_logo' => 'nullable|image|max:2048',
            'selectedSkills' => 'required|array|min:1',
            'selectedSkills.*' => 'exists:skills,id',
        ];
    }
    protected JobServicesInterface $jobServices;

    public function boot(JobServicesInterface $JobServices)
    {
        $this->jobServices = $JobServices;
    }
    public function update()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => $this->extra_info,
            'company_name' => $this->company_name,
            'selectedSkills' => $this->selectedSkills,
        ];

        $this->authorize('update', $this->job);
        $this->jobServices->update($this->job, $data, $this->new_company_logo);

        $this->dispatch('showToast', message: 'Job updated successfully', type: 'success')->to(ToastComponent::class);
        return redirect()->route('admin.jobs.index');
    }

    public function render()
    {
        $skills = Skill::all();
        return view('livewire.pages.jobs.edit', compact('skills'));
    }
}