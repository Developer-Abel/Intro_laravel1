<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\SaveProyectRequest;

class ProjectController extends Controller{
    public function index(){
        $proyectos = Project::latest()->paginate();
        return view('projects.index', compact('proyectos'));
    }
    public function show(Project $project){
        // $project = Project::findOrFail($id);
        return view('projects.show',[
            'project' => $project
        ]);
    }

    public function create (){
       return view('projects.create',[
           'project' => new Project()
       ]);
    }

    public function store(SaveProyectRequest $request){
        Project::create($request->validated());
        return redirect()->route('project.index')->with('status', 'El proyecto fue creado con éxito');
    }
    public function edit(Project $project){
        return view('projects.edit',[
            'project' =>$project
        ]);
    }
    public function update(Project $project, SaveProyectRequest $request){
        $project->update( $request->validated() );
        return redirect()->route('project.show', $project)->with('status', 'El proyecto fue actualizado con éxito');
    }

    public function destroy(Project $project){
        $project->delete();
        return redirect()->route('project.index')->with('status', 'El proyecto fue eliminado con éxito');
    }
}
