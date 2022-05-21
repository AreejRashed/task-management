<?php

namespace App\Http\Controllers;

use App\Mail\UserWelcomeEmail;
use App\Models\Admin;
use App\Models\Scope;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('scope')->withCount('permissions')->get();
        return response()->view('cms.users.index', ['users' => $users]);
    }

    public function updateUserPermissions(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);
        if (!$validator->fails()) {
            //SELECT * FROM permissions where guard_name = 'user' AND id = 1;
            // $permission = Permission::findById($request->input('permission_id'), 'user');
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($user->hasPermissionTo($permission)) {
                $user->revokePermissionTo($permission);
            } else {
                $user->givePermissionTo($permission);
            }
            return response()->json(['message' => 'Permission updated successfully'], Response::HTTP_OK);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }



    public function editUserPermissions(Request $request, User $user)
    {
        $permissions = Permission::where('guard_name', '=', 'user')
            ->orWhere('guard_name', '=', 'user-api')
            ->get();
        $userPermissions = $user->permissions;
        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);
            foreach ($userPermissions as $userPermission) {
                if ($permission->id == $userPermission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }

        return response()->view('cms.users.user-permissions', ['permissions' => $permissions, 'user' => $user]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scopes = Scope::all();
        return response()->view('cms.users.create', ['scopes' => $scopes]);
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
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:admins,email',
            'address' => 'required|string|min:3',
            'scope_id' => 'required|numeric|exists:scopes,id',
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->scope_id = $request->input('scope_id');
            $user->password = Hash::make(12345);
            $isSaved =$user->save();
            if ($isSaved) {
                Mail::to($user)->send(new UserWelcomeEmail($user));
                
            }


            return response()->json(
                ['message' => $isSaved ? 'saved successfuly' : 'saved failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $scopes = Scope::all();
        return response()->view('cms.users.edite', ['user' => $user, 'scopes' => $scopes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:admins,email,'  . $user->id,
            'address' => 'required|string|min:3',
            'scope_id' => 'required|numeric|exists:scopes,id',
        ]);
        if (!$validator->fails()) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->scope_id = $request->input('scope_id');
            $user->password = Hash::make(12345);
            $isSaved = $user->save();
            return response()->json(
                ['message' => $isSaved ? 'saved successfuly' : 'saved failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
