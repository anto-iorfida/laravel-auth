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

                        <div>
                            <a href="{{ route('admin.project.edit', ['project' => $project->id]) }}">Edit</a>
                        </div>

                        <div>
                            <form id="delete-form-{{ $project->id }}"
                                action="{{ route('admin.project.destroy', ['project' => $project->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-project-name="{{ $project->name }}"
                                    class="btn btn-danger js-delete-btn">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.js-delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {

                // prevenire l'invio predefinito del modulo
                event.preventDefault();
                // ottenere il modulo più vicino al bottone cliccato
                const form = button.closest('form');

                // ottenere il titolo del fumetto dall'attributo data-project-name
                const projectName = button.getAttribute('data-project-name');

                // mostrare il popup di conferma
                const confirmed = confirm(`Sei sicuro di voler eliminare "${projectName}"?`);

                // se l'utente conferma, invia il modulo
                // altrimenti, non fare nulla (azione di eliminazione annullata)
                if (confirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
