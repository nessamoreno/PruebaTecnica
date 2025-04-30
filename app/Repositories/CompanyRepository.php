<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAll(array $filters): LengthAwarePaginator
    {
        return Company::query()
            ->when($filters['document_type'] ?? null, fn($q, $v) => $q->where('document_type', $v))
            ->when($filters['document_number'] ?? null, fn($q, $v) => $q->where('document_number', $v))
            ->when($filters['first_name'] ?? null, fn($q, $v) => $q->where('first_name', 'like', "%$v%"))
            ->when($filters['last_name'] ?? null, fn($q, $v) => $q->where('last_name', 'like', "%$v%"))
            ->when($filters['phone'] ?? null, fn($q, $v) => $q->where('phone', $v))
            ->latest()
            ->paginate(5);
    }

    public function find(int $id): ?Company
    {
        return Company::find($id);
    }

    public function create(array $data): Company
    {
        return Company::create($data);
    }

    public function update(Company $company, array $data): bool
    {
        return $company->update($data);
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }
}