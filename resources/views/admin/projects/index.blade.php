@extends('layouts.admin')

@section('content')
<h1>Tutti i progetti</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Client Name</th>
            <th>Summary</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->slug }}</td>
                <td>{{ $project->client_name }}</td>
                <td>{{ $project->summary }}</td>

                <td>
                    <div>
                        <a href="{{ route('admin.project.show', ['project' => $project->id]) }}">View</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection