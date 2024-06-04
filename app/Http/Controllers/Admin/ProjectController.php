<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('ciao');
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:5|max:150|unique:projects,name',
                'client_name' => 'required|min:5|max:20',
                'summary' => 'nullable|min:10'
            ]
        );

        $formData = $request->all();
        // dd($formData);
        $newProject = new Project();
        $newProject->fill($formData);
        // o si mette dopo che popolo $newProject senno la variabile è vuota oopure metto formData['name] al posto di $newProject->name
        $newProject->slug = Str::slug($newProject->name, '-');
        $newProject->save();

        session()->flash('project_create', true);

        return redirect()->route('admin.project.show', ['project' => $newProject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::findOfFail($id); al  posto suo utiliziamo delle Dependency Injection Un design pattern che permette di iniettare le dipendenze necessarie in un componente, piuttosto che farle creare o trovare autonomamente.
        $data = [
            'project' => $project
        ];
        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $request->validate(
            [
                'name' => [
                    'required',
                    'min:5',
                    'max:150',
                    // 'unique:posts,title'
                    // si può mettere anche senza id
                    Rule::unique('projects')->ignore($project->id)
                ],
                'client_name' => 'required|min:5|max:20',
                'summary' => 'nullable|min:10'
            ]
        );


        $formData = $request->all();
        $project->slug = Str::slug($formData['name'], '-');
        $project->update($formData);

        session()->flash('project_edit', true);


        return redirect()->route('admin.project.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        // dd('eliminato');
        // memorizzare temporaneamente un dato nella sessione dell'utente. Questo dato sarà disponibile solo per la prossima richiesta HTTP e poi sarà automaticamente rimosso.
        session()->flash('project_deleted', true);
        return redirect()->route('admin.project.index');
    }
}
