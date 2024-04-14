<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
// use App\Http\Controllers\Admin\Arr;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     
     */
    public function index()
    {
        $project = Project::paginate(15);
        return view('admin.project.index', compact('project'));

    }

    /**
     * Show the form for creating a new resource.
     *
     
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     
     */
    public function store(Request $request)
    {
        $request->validate(
            [

                'technologies' => 'nullable|exists:technologies,id',
            ],
            [

                'technologies.exists' => 'I tag selezionati non sono validi',
            ]
        );

        $data = $request->all();
        $new_project = new Project;
        $new_project->fill($data);
        $new_project->save();

        if (Arr::exists($data, "technologies"))
            $new_project->technologies()->attach($data["technologies"]);

        return redirect()->route('admin.projects.show', $new_project)->with('message', 'Project Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project $project
    
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project $project
    
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project $project
     
     */
    public function update(EditProjectRequest $request, Project $project)
    {

        $request->validated();

        $data = $request->all();
        $project->update($data);

        if (Arr::exists($data, "technologies"))
            $project->technologies()->sync($data["technologies"]);
        else
            $project->technologies()->detach();

        return redirect()->route('admin.projects.show', compact('project'))->with('message', 'Project Modified');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project $project
     
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Project Deleted');
    }
}
