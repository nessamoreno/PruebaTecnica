<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    
    public function index(Request $request)
    {
        $companies = Company::query()
            ->when($request->document_type, fn($q) => $q->where('document_type', $request->document_type))
            ->when($request->document_number, fn($q) => $q->where('document_number', $request->document_number))
            ->when($request->first_name, fn($q) => $q->where('first_name', 'like', "%{$request->first_name}%"))
            ->when($request->last_name, fn($q) => $q->where('last_name', 'like', "%{$request->last_name}%"))
            ->when($request->phone, fn($q) => $q->where('phone', $request->phone))
            ->latest()
            ->paginate(5);

            return view('companies.index', compact('companies'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyStoreRequest $request)
    {
        $data = $request->validated();

        if ($data['document_type'] === 'NIT') {
            [$firstName, $lastName] = $this->splitName($data['first_name']);
            $data['first_name'] = $firstName;
            $data['last_name'] = $lastName;
        }

        $data['full_name'] = $data['first_name'] . ' ' . $data['last_name'];

        Company::create($data);
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
        
        //Company::create($request->validated());
        //return redirect()->route('companies.index')
                         //->with('success', 'Empresa creada exitosamente.');
    }

    private function splitName($fullName): array
    {
        $words = explode(' ', trim($fullName));

        if (count($words) <= 2) {
            return [$words[0] ?? '', $words[1] ?? ''];
        }

        $mid = intval(count($words) / 2);
        $firstName = implode(' ', array_slice($words, 0, $mid));
        $lastName = implode(' ', array_slice($words, $mid));

        return [$firstName, $lastName];
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company): View
    {
        return view('companies.edit',compact('company'));
    }

    public function update(CompanyUpdateRequest $request, Company $company): RedirectResponse
    {
        $data = $request->validated();

        if ($data['document_type'] === 'NIT') {
            $words = explode(' ', $data['first_name']);
            $data['first_name'] = implode(' ', array_slice($words, 0, count($words) - 2));
            $data['last_name'] = implode(' ', array_slice($words, -2));
        }

        $data['full_name'] = trim($data['first_name'] . ' ' . $data['last_name']);

        $company->update($data);
        return redirect()->route('companies.index')->with('success', 'Empresa actualizada exitosamente.');
        
        //$company->update($request->validated());
        //return redirect()->route('companies.index')->with('success','Empresa actualizada exitosamente');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('companies.index')
                        ->with('success','Empresa eliminada exitosamente');
    }
}
