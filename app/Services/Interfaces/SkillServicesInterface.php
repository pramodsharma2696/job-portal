<?php

namespace App\Services\Interfaces;

interface SkillServicesInterface
{
    public function listPaginated($perPage = 7);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function find($id);
}
