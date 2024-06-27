<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectCtroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ? $request->per_page : 10;
        // $projects = Project::all();
        $projects = Project::paginate($perPage);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        return view('admin.projects.create', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->all();
        // dd($data);
        $newProject = new Project();
        $newProject->fill($data);
        $newProject->slug = Str::slug($request->name);
        $newProject->save();

        if($request->has('technologies')) {
            $newProject->technologys()->attach($request->technologies);
        }
        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $technologies = Technology::all();
        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $types = Type::all();
        $project = Project::where('slug', $slug)->first();
        if(!$project) {
            abort(404);
        }

        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // dd($request->all());
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $project->update($data);

        $project->technologys()->sync($request->technologies);

        return redirect()->route('admin.projects.show', ['project'=> $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologys()->detach();
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'The project '. $project->name . ' is delete!');
    }
}
