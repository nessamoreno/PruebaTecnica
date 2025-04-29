@extends('companies.layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <h3 class="card-header">Detalles del Usuario</h3>
        <div class="card-body">

            <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">
                <i class="fa fa-arrow-left"></i> Volver
            </a>

            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Rol:</strong> {{ $user->role->name ?? 'Sin rol asignado' }}</p>
        </div>

        <h4>Conteo de Letras:</h4>
    <ul>
        @foreach($letterCount as $letter => $count)
            <li><strong>{{ $letter }}:</strong> {{ $count }}</li>
        @endforeach
    </ul>

    <a href="{{ route('users.index') }}" class="btn btn-primary">Volver</a>
    </div>
</div>
@endsection