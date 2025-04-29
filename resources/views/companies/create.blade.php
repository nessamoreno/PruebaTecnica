@extends('companies.layout')

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Agregar Nueva Empresa</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('companies.index') }}">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>
    
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

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
            <input type="text" name="document_number" class="form-control @error('document_number') is-invalid @enderror" placeholder="Número de documento">
            @error('document_number')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Nombres:</strong></label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Nombres">
            @error('first_name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Apellidos:</strong></label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Apellidos">
            @error('last_name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Dirección:</strong></label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección">
            @error('address')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Teléfono:</strong></label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Teléfono">
            @error('phone')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Celular:</strong></label>
            <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Celular">
            @error('mobile')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Correo Electrónico:</strong></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo Electrónico">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Usuario:</strong></label>
            <input type="text" name="user" class="form-control @error('user') is-invalid @enderror" placeholder="Usuario">
            @error('user')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-floppy-disk"></i> Guardar
        </button>
    </form>

  </div>
</div>
@endsection