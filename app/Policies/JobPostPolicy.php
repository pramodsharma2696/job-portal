<?php

namespace App\Policies;

use App\Models\JobPost;
use App\Models\User;

class JobPostPolicy
{
    /**
     * Determine whether the user can view any job posts.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('job.view');
    }

    /**
     * Determine whether the user can view a specific job post.
     */
    public function view(User $user, JobPost $jobPost): bool
    {
        return $user->can('job.view');
    }

    /**
     * Determine whether the user can create a job post.
     */
    public function create(User $user): bool
    {
        return $user->can('job.create');
    }

    /**
     * Determine whether the user can update the job post.
     */
    public function update(User $user, JobPost $jobPost): bool
    {
        return $user->can('job.update') && (
            $user->id === $jobPost->user_id || $user->hasRole('admin')
        );
    }

    /**
     * Determine whether the user can delete the job post.
     */
    public function delete(User $user, JobPost $jobPost): bool
    {
        return $user->can('job.delete') && (
            $user->id === $jobPost->user_id || $user->hasRole('admin')
        );
    }
}
