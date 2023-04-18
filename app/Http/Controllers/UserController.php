<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('administrate')) {
            abort(403);
        }

       return view('users.index', [
           'users' => User::latest()->paginate(10)
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('administrate')) {
            abort(403);
        }

        $roles =  Cache::remember('roles.all', 60 * 60, function(){
                    return Role::get();
                    });

        return view('users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        if (Gate::denies('administrate')) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'is_active' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'selected_roles' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new user
        try {
            DB::beginTransaction();

            $user = new User;
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->is_active = $request->input('is_active') ?? false;
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            $user->roles()->sync($request->input('selected_roles'));

            DB::commit();

            return response()->json(['message' => 'User created successfully!'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'An error occurred while creating the user. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('administrate')) {
            abort(403);
        }

        $roles =  Cache::remember('roles.all', 60 * 60, function(){
            return Role::get();
        });

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        if (Gate::denies('administrate')) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'is_active' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $id,
//            'password' => 'nullable|confirmed|min:8',
            'selected_roles' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->is_active = !is_null($request->input('is_active'));
            $user->email = $request->input('email');
            $user->save();

            $user->roles()->sync($request->input('selected_roles'));

            DB::commit();

            return response()->json(['message' => 'User updated successfully!'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'An error occurred while updating the user. Please try again later.'], 422);
        }
    }

    public function delete($user_id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($user_id);
            $user->delete();

            DB::commit();

            return response()->json(['message' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to delete user. Please try again.']);
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->paginate(10);

        return view('users.index')->with('users', $users)->render();
    }
}
