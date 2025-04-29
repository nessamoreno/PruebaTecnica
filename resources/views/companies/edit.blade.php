@extends('companies.layout')

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Editar Empresa</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('companies.index') }}">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>

    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
    <label for="inputDocumentType" class="form-label"><strong>Document Type:</strong></label>
    <select name="document_type" id="inputDocumentType" class="form-control @error('document_type') is-invalid @enderror">
        <option value="NIT" {{ old('document_type') == 'NIT' ? 'selected' : '' }}>NIT</option>
        <option value="CC" {{ old('document_type') == 'CC' ? 'selected' : '' }}>CC</option>
    </select>
    @error('document_type')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>

        <div class="mb-3">
            <label class="form-label"><strong>Número de Documento:</strong></label>
            <input type="text" name="document_number" value="{{ old('document_number', $company->document_number) }}" class="form-control @error('document_number') is-invalid @enderror" placeholder="Número de documento">
            @error('document_number')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Nombres:</strong></label>
            <input type="text" name="first_name" value="{{ old('first_name', $company->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="Nombres">
            @error('first_name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Apellidos:</strong></label>
            <input type="text" name="last_name" value="{{ old('last_name', $company->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="Apellidos">
            @error('last_name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Dirección:</strong></label>
            <input type="text" name="address" value="{{ old('address', $company->address) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección">
            @error('address')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Teléfono:</strong></label>
            <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Teléfono">
            @error('phone')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Celular:</strong></label>
            <input type="text" name="mobile" value="{{ old('mobile', $company->mobile) }}" class="form-control @error('mobile') is-invalid @enderror" placeholder="Celular">
            @error('mobile')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Correo Electrónico:</strong></label>
            <input type="email" name="email" value="{{ old('email', $company->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Usuario:</strong></label>
            <input type="text" name="user" value="{{ old('user', $company->user) }}" class="form-control @error('user') is-invalid @enderror" placeholder="Usuario">
            @error('user')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-floppy-disk"></i> Actualizar
        </button>
    </form>

  </div>
</div>
@endsection