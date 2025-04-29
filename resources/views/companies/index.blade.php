@extends('companies.layout')

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Growing Network</h2>
  <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success" role="alert"> 
                {{ session('success') }}
            </div>
        @endif

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'super')
                <a class="btn btn-success btn-sm" href="{{ route('companies.create') }}">
                    <i class="fa fa-plus"></i> Crear Empresa
                </a>
                <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                    <i class="fa fa-plus"></i> Crear Usuario
                </a>
            @endif
        </div>

        <form method="GET" action="{{ route('companies.index') }}" class="mb-4">
            <div class="row">
                <div class="col">
                    <input type="text" name="document_type" class="form-control" placeholder="Tipo Documento" value="{{ request('document_type') }}">
                </div>
                <div class="col">
                    <input type="text" name="document_number" class="form-control" placeholder="Documento" value="{{ request('document_number') }}">
                </div>
                <div class="col">
                    <input type="text" name="first_name" class="form-control" placeholder="Nombres" value="{{ request('first_name') }}">
                </div>
                <div class="col">
                    <input type="text" name="last_name" class="form-control" placeholder="Apellidos" value="{{ request('last_name') }}">
                </div>
                <div class="col">
                    <input type="text" name="phone" class="form-control" placeholder="Teléfono" value="{{ request('phone') }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Tipo de documento</th>
                    <th>Número de documentos</th>
                    <th>Nombres</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                    <th>Correo Electronico</th>
                    <th>Usuario</th>
                    <th width="250px">Acciones</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($companies as $company)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $company->document_type }}</td>
                    <td>{{ $company->document_number }}</td>
                    <td>{{ $company->first_name }}</td>
                    <td>{{ $company->last_name }}</td>
                    <td>{{ $company->address }}</td>
                    <td>{{ $company->phone }}</td>
                    <td>{{ $company->mobile }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->user }}</td>
                    <td>
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST">

                            <a class="btn btn-info btn-sm" href="{{ route('companies.show', $company->id) }}">
                                <i class="fa-solid fa-list"></i> Ver
                            </a>

                            @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'super')
    <a class="btn btn-primary btn-sm" href="{{ route('companies.edit', $company->id) }}">
        <i class="fa-solid fa-pen-to-square"></i> Editar
    </a>

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta empresa?')">
        <i class="fa-solid fa-trash"></i> Eliminar
    </button>
@endif
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">No hay datos disponibles.</td>
                </tr>
            @endforelse
            </tbody>

        </table>

        {!! $companies->links() !!}

  </div>
  @auth
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">
            Cerrar Sesión
        </button>
    </form>
@endauth
<a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
</div>

@endsection