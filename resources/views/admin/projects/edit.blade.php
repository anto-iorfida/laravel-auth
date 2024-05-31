@extends('layouts.admin')

@section('content')

<h2>Modifica il Progetto: {{ $project->name }}</h2>

<form action="{{ route('admin.project.update', ['project' => $project->id]) }}" method="POST">
    @csrf
    @method('PUT')

    
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}">
    </div>

    <div class="mb-3">
        <label for="client_name" class="form-label">Cliente</label>
        <input type="text" class="form-control" id="client_name" name="client_name" value="{{ $project->client_name }}">
    </div>

    <div class="mb-3">
        <label for="summary" class="form-label">Contenuto Progetto</label>
        <textarea class="form-control" id="summary" rows="10" name="summary">{{ $project->summary }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Modifica</button>
</form>
    
@endsection