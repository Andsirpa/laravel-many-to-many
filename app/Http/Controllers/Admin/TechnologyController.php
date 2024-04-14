<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function create()
    {
        $project = new Project;

        $technologies = Technology::orderBy('label')->get();
        return view('admin.projects.form', compact('project', 'technologies'));
    }

    public function edit(Project $project)
    {
        $technologies = Technology::orderBy('label')->get();
        $project_technologies = $project->tags->pluck('id')->toArray();
        return view('admin.projects.form', compact('project', 'technologies', 'project_technologies'));
    }


}


