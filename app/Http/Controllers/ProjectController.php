<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Material;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:projects.index')->only('index');
        $this->middleware('permission:projects.create')->only(['create', 'store']);
        $this->middleware('permission:projects.edit')->only(['edit', 'update']);
        $this->middleware('permission:projects.show')->only('show');
        $this->middleware('permission:projects.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Project::rules());

        Project::create($request->all());

        return back()->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $materials = $project->materials;
        return view('projects.show', compact('project', 'materials'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request, Project::rules());

        $project->update($request->all());

        return redirect()->route('projects.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }

    public function getAssign()
    {
        $projects = Project::select('name', 'id')
            ->pluck('name', 'id')->prepend('Seleccione un proyecto', '');

        $materials = Material::select('name', 'id')
            ->pluck('name', 'id')->prepend('Seleccione un material', '');

        return view('projects.assign', compact('projects', 'materials'));
    }

    public function assign(Request $request, Project $project)
    {
        try {
            $project->materials()->attach($request->materials);
            $message = 'Materiales agregados correctamente';
            $status = 'ok';
        } catch (\Throwable $th) {
            if ($th->getCode() === '22003') {
                $message = 'La cantidad solicitada no esta disponible en bodega';
            } else {
                $message = 'Error ' . $th->getMessage();
            }

            $status = 'error';
        }

        return response()->json([
            'message' => $message,
            'status' => $status,
        ]);
    }
}
