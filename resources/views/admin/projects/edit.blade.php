@extends('layouts.admin')

@section('content')
    <h2>Modifica il Progetto: {{ $project->name }}</h2>

    <form action="{{ route('admin.project.update', ['project' => $project->id]) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$project->name) }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="client_name" class="form-label">Cliente</label>
            <input type="text" class="form-control" id="client_name" name="client_name"
                value="{{ old('client_name',$project->client_name)  }}">
        </div>
        @error('client_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="summary" class="form-label">Contenuto Progetto</label>
            <textarea class="form-control" id="summary" rows="10" name="summary">{{ old('summary',$project->summary)  }}</textarea>
        </div>
        @error('summary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
@endsection
