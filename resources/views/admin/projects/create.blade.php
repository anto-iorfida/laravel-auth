@extends('layouts.admin')

@section('content')
<h2>Crea un nuovo progetto</h2>

<form action="{{ route('admin.project.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="mb-3">
        <label for="client_name" class="form-label">Cliente</label>
        <input type="text" class="form-control" id="client_name" name="client_name">
    </div>

    <div class="mb-3">
        <label for="summary" class="form-label">Contenuto Progetto</label>
        <textarea class="form-control" id="summary" rows="10" name="summary"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Salva</button>
</form>
    
@endsection