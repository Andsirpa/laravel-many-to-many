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


        $post = new Project;
        $post->fill($data);
        $post->save();


        if (Arr::exists($data, "technologies"))
            $post->technologies()->attach($data["technologies"]);
    }


}


