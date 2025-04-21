<?php

namespace App\Repositories\Interfaces;

use App\Models\JobPost;

interface JobRepositoryInterface
{
    public function paginate($perPage = 10);
    public function create(array $data);
    public function update(JobPost $jobPost, array $data);
    public function find($id);
    public function delete($id);
}
