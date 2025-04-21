<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\SkillRepository;
use App\Services\Interfaces\SkillServicesInterface;

class SkillServices implements SkillServicesInterface
{
    protected $skillRepo;

    public function __construct(SkillRepository $skillRepo)
    {
        $this->skillRepo = $skillRepo;
    }

    public function listPaginated($perPage = 7)
    {
        return $this->skillRepo->paginate($perPage);
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->skillRepo->create($data);
    }

    public function update($id, array $data)
    {
        $skill = $this->skillRepo->find($id);
        $data['user_id'] = Auth::id();
        $this->skillRepo->update($skill, $data);
        return $skill;
    }

    public function delete($id)
    {
        return $this->skillRepo->delete($id);
    }

    public function find($id)
    {
        return $this->skillRepo->find($id);
    }
}
