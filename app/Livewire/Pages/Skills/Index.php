<?php 
namespace App\Livewire\Pages\Skills;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Pages\ToastComponent;
use App\Services\Interfaces\SkillServicesInterface;


class Index extends Component
{
    use WithPagination;

    public $title;
    public $user_id;
    public $skillId = null;

    protected SkillServicesInterface $skillService;

    public function boot(SkillServicesInterface $skillService)
    {
        $this->skillService = $skillService;
    }

    public function render()
    {   
        $skills = $this->skillService->listPaginated(7);
        return view('livewire.pages.skills.index', compact('skills'));
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255'
        ]);
        

        $this->authorize('create', Skill::class);

        $this->skillService->create(['title' => $this->title]);

        $this->resetFields();
        $this->dispatch('showToast', message: 'Skill added successfully!', type: 'success')->to(ToastComponent::class);
    }

    public function edit($id)
    {
        $skill = $this->skillService->find($id);

        $this->authorize('update', $skill);

        $this->skillId = $skill->id;
        $this->title = $skill->title;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255'
        ]);
                
        $this->authorize('update', Skill::find($this->skillId));

        $this->skillService->update($this->skillId, ['title' => $this->title]);

        $this->resetFields();
        $this->dispatch('showToast', message: 'Skill updated successfully!', type: 'success')->to(ToastComponent::class);
    }

    public function delete($id)
    {
        $skill = $this->skillService->find($id);
        $this->authorize('delete', $skill);
        
        $this->skillService->delete($id);
        $this->dispatch('showToast', message: 'Skill deleted successfully!', type: 'success')->to(ToastComponent::class);
    }

    public function cancelEdit()
    {
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->title = '';
        $this->user_id = '';
        $this->skillId = null;
    }
}
