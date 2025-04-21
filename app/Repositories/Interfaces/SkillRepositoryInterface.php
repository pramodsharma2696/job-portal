<?php

namespace App\Repositories\Interfaces;

use App\Models\Skill;

interface SkillRepositoryInterface
{
    public function paginate($perPage = 7);
    public function create(array $data);
    public function find($id);
    public function update(Skill $skill, array $data);
    public function delete($id);
}
