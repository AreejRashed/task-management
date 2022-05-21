<?php

namespace App\Http\Controllers;

use App\Models\Scope;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScopeController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Role::class, 'scope');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scopes = Scope::withCount('users')->get();
        return response()->view('cms.scopes.index', ['scopes' => $scopes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.scopes.create');
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
            ]);

        if (!$validator->fails()) {
            $scope = new Scope();
            $scope->name = $request->input('name');
            $isSaved = $scope->save();
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
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function show(Scope $scope)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function edit(Scope $scope)
    {
        return response()->view('cms.scopes.edit', ['scope' => $scope]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scope $scope)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:250',
        ]);
        if (!$validator->fails()) {
            $scope->name = $request->input('name');
            $isSaved = $scope->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scope $scope)
    {
        $deleted = $scope->delete();
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
