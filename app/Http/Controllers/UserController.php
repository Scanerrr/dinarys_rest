<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')
            ->except(['index', 'show']);
    }

    /**
     * Show all users
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index() {
        $users = User::all();
        return response()
            ->json([
                'users' => $users
            ]);
    }

    /**
     * Show user by id
     *
     * @param User $user
     * @return User
     */
    public function show(User $user) {
        return response()
            ->json([
                'user' => $user
            ]);
    }

    /**
     * Get creation form
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $form = User::form();
        return response()
            ->json([
                'form' => $form
            ]);
    }

    /**
     * Create user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $user = User::create($request->all());
        return response()
            ->json([
                'saved' => true,
                'id' => $user->id,
                'message' => 'You have successfully created user!'
            ]);
    }

    /**
     * Get form for editing
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $form = User::findOrFail($id, [
                'id', 'name', 'email', 'latitude', 'longitude'
            ]);
        return response()
            ->json([
                'form' => $form
            ]);
    }

    /**
     * Update user fields
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user) {
        $user->update($request->all());
        return response()
            ->json([
                'saved' => true,
                'id' => $user->id,
                'message' => 'You have successfully updated user!'
            ]);
    }

    /**
     * Remove user by id
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user) {
        $user->delete();
        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
