<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller{
    public function index(){
        $proyectos = Project::latest()->paginate();
        return view('projects.index', compact('proyectos'));
    }
    public function show($id){
        $project = Project::findOrFail($id);
        return view('projects.show',[
            'project' => $project
        ]);
    }
}
