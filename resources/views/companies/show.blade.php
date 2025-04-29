@extends('companies.layout')

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Ver Empresa</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('companies.index') }}">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="row mt-3">
        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Tipo de Documento:</strong><br/>
                {{ $company->document_type }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Número de Documento:</strong><br/>
                {{ $company->document_number }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Nombres:</strong><br/>
                {{ $company->first_name }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Apellidos:</strong><br/>
                {{ $company->last_name }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Nombre completo:</strong><br/>
                    {{ $company->full_name }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Dirección:</strong><br/>
                {{ $company->address }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Teléfono:</strong><br/>
                {{ $company->phone }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Celular:</strong><br/>
                {{ $company->mobile }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Correo Electrónico:</strong><br/>
                {{ $company->email }}
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-group">
                <strong>Usuario:</strong><br/>
                {{ $company->user }}
            </div>
        </div>
    </div>

  </div>
</div>
@endsection