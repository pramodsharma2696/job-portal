<?php 

namespace App\Repositories;

use App\Models\Skill;
use App\Repositories\Interfaces\SkillRepositoryInterface;


class SkillRepository implements SkillRepositoryInterface 
{
    public function paginate($perPage = 7)
    {
        return Skill::latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return Skill::create($data);
    }

    public function find($id)
    {
        return Skill::findOrFail($id);
    }

    public function update(Skill $skill, array $data)
    {
        return $skill->update($data);
    }

    public function delete($id)
    {
        return Skill::findOrFail($id)->delete();
    }
}
