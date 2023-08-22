<?php

namespace App\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Roles\Role;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        return User::paginate();
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCurrentUser()
    {
        return \Auth::user();
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $params = $request->all();

        if (array_key_exists('permissions', $params)) {
            $this->authorize('updatePermissions', $user);
        }

        $this->userRepository->update($user, $params);
    }

    public function removeRole(User $user, Role $role)
    {
        $this->authorize('updateRoles', $user);

        $user->removeRole($role);
    }

    public function assignRole(User $user, Role $role)
    {
        $this->authorize('updateRoles', $user);

        $user->assignRole($role);
    }

}
