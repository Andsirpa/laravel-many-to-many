<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     
     */
    public function index()
    {
        $post = Project::paginate(15);
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
        $request->validated();

        $data = $request->all();
        $new_project = new Project;
        $new_project->fill($data);
        $new_project->save();

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
