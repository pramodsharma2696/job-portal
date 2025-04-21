<?php

namespace App\Services\Interfaces;

interface JobServicesInterface
{
    public function listPaginated($perPage = 10);
    public function create(array $data, $company_logo = null);
    public function update($jobPost, array $data, $new_company_logo = null);
    public function delete($id);
    public function find($id);
}
