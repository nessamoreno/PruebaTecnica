<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Company;

interface CompanyRepositoryInterface
{
    public function getAll(array $filters): LengthAwarePaginator;
    public function find(int $id): ?Company;
    public function create(array $data): Company;
    public function update(Company $company, array $data): bool;
    public function delete(Company $company): bool;
}
