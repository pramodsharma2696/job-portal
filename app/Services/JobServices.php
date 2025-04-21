<?php

namespace App\Services;

use Livewire\WithFileUploads;
use App\Helper\ResponseHelper;
use App\Repositories\JobRepository;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\JobServicesInterface;


class JobServices implements JobServicesInterface
{

    use WithFileUploads;
    protected $jobRepo;

    public function __construct(JobRepository $JobRepository)
    {
        $this->jobRepo = $JobRepository;
    }

    public function listPaginated($perPage = 10)
    {
        return $this->jobRepo->paginate($perPage);
    }

    public function create(array $data, $company_logo = null)
    {
        $data['user_id'] =  Auth::id();
        $data['company_logo'] = $company_logo ? ResponseHelper::uploadImage($company_logo, 'jobs') : null;

        $selectedSkills = $data['selectedSkills'] ?? [];
        unset($data['selectedSkills']);
        $jobPost = $this->jobRepo->create($data);

        // Attach multiple skills
        if (!empty($selectedSkills)) {
            $jobPost->skills()->attach($selectedSkills);
        }

        return $jobPost;
    }

    public function update($jobPost, array $data, $new_company_logo = null)
    {
        if ($new_company_logo) {
            // Delete old image if exists
            if ($jobPost->company_logo) {
                ResponseHelper::deleteImage($jobPost->company_logo);
            }

            // Upload new image
            $data['company_logo'] = ResponseHelper::uploadImage($new_company_logo, 'jobs');
        } else {
            // Keep existing logo if new one is not provided
            $data['company_logo'] = $jobPost->company_logo;
        }

        // Detach selected skills from $data for syncing separately
        $selectedSkills = $data['selectedSkills'] ?? [];
        unset($data['selectedSkills']);

        // Update main job post
        $this->jobRepo->update($jobPost, $data);

        // Sync skills if provided
        if (!empty($selectedSkills)) {
            $jobPost->skills()->sync($selectedSkills);
        }

        return $jobPost;
    }


    public function delete($id)
    {
        $this->jobRepo->delete($id);
    }

    public function find($id)
    {
        return $this->jobRepo->find($id);
    }

}
