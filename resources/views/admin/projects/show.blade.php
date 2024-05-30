@extends('layouts.admin')

@section('content')
    <h2>{{ $project->name }}</h2>

    <div>
        slug: {{$project->slug}}
    </div>

    <div>
        <strong>data created:</strong> {{$project->created_at}}
    </div>
    <div>
        <strong>data updated:</strong> {{$project->updated_at}}
    </div>

    @if ($project->summary)
        <p>{{ $project->summary }}</p>
    @endif
@endsection
