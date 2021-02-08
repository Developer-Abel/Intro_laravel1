<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProyectRequest;

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
       return view('projects.create');
    }

    public function store(CreateProyectRequest $request){
        Project::create($request->validated());
        return redirect()->route('projects.index');
    }
}
