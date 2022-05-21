<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Donor;
use App\Models\Project;
use App\Models\ProjectBeneficiaries;
use App\Models\Scope;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return response()->view('cms.project.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $donors = Donor::all();
        $categories = Category::all();
        $scopes = Scope::all();
        return response()->view('cms.project.create', 
        [
            'scopes' => $scopes,
            'donors' => $donors,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:250',
            'start' => 'required|string|max:250',
            'end' => 'required|string|max:250',
            'amount' => 'required|string|min:1|max:250',
            'donor_id' => 'required|numeric|exists:donors,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'scope_id' => 'required|numeric|exists:scopes,id',
        ]);
        if (!$validator->fails()) {
            $project = new Project();
            $project->name = $request->input('name');
            $project->start = $request->input('start');
            $project->end = $request->input('end');
            $project->amount = $request->input('amount');
            $project->donor_id = $request->input('donor_id');
            $project->scope_id = $request->input('scope_id');
            $project->category_id = $request->input('category_id');

            $isSaved = $project->save();
            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $users = ProjectBeneficiaries::where('project_id' ,'=', $project->id)->get();
        // dd($beneficiaries);
        return response()->view('cms.project.show',['users'=>$users]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
