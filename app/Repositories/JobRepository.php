<?php 

namespace App\Repositories;

use App\Models\JobPost;
use App\Repositories\Interfaces\JobRepositoryInterface;

class JobRepository implements JobRepositoryInterface  {
    
    public function paginate($perPage = 10)
    {
        return JobPost::latest()->paginate($perPage);
        
    }

    public function create(array $data)
    {
      
        try {
            return JobPost::create($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
            session()->flash('error', 'Failed to create job in repo: ' . $e->getMessage());
        }
    }
    public function update(JobPost $jobPost, array $data): bool
    {
        return $jobPost->update($data);
    }

    public function find($id)
    {
        return JobPost::find($id);
    }

    public function delete($id)
    {
        JobPost::findOrFail($id)->delete();
    }

}