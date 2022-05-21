<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Project;
use App\Models\ProjectBeneficiaries;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectBeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return response()->view('cms.project.register', ['users' => $users,'projects' => $projects]);
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
            'user_id' => 'required|numeric|exists:users,id',
            'project_id' => 'required|numeric|exists:projects,id',
        ]);

        if (!$validator->fails()) {
            $projectBeneficiaries = new ProjectBeneficiaries();
            $projectBeneficiaries->user_id = $request->input('user_id');
            $projectBeneficiaries->project_id = $request->input('project_id');
            $users = ProjectBeneficiaries::where('user_id', '=', $projectBeneficiaries->user_id)
            ->where('project_id', '=', $projectBeneficiaries->project_id)
            ->get();
            $isRegister = is_null($users->first());
            if($isRegister){
                $isSaved = $projectBeneficiaries->save();
                return response()->json([
                    'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
                ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
            }else{
                return response()->json([
                    'message' => 'already register !'
                ],Response::HTTP_BAD_REQUEST);
            }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $beneficiary = ProjectBeneficiaries::findOrFail($id);
        $deleted = $beneficiary->delete();
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'scope deleted successfully' : 'scope deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
