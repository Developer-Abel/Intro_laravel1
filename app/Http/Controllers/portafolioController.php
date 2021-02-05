<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class portafolioController extends Controller{
    public function index(){
        $proyectos = Project::latest()->paginate(2);
        return view('portfolio', compact('proyectos'));
    }
}
