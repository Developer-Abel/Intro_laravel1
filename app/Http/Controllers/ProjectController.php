<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

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

    public function store(){
        $datos = request()->validate([
            'title' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);
        Project::create($datos);

        return redirect()->route('projects.index');
    }
}
