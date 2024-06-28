<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::id();
        // dd(Auth::user());
        $projects = Project::where('user_id', $user)->paginate($perPage);
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
        // $data = $request->all();
        $data = $request->validated(); //solo le richieste validate
        $data["user_id"] = Auth::id();
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
        if($project->user_id !== Auth::id()){
            abort(403); // non serve mettere l'errore corretta, avolte possiamo fingere un'altro errore cosi da non fare capire la struttura del nostro database
        }
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

        if($project->user_id !== Auth::id()){
            abort(403); 
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
        if($project->user_id !== Auth::id()){
            abort(403); 
        }
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
        if($project->user_id !== Auth::id()){
            abort(403);
        }
        $project->technologys()->detach();
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'The project '. $project->name . ' is delete!');
    }
}
