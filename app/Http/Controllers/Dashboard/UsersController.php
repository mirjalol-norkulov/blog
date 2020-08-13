<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Users\UserCreateRequest;
use App\Http\Requests\Dashboard\Users\UserEditRequest;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query->get('q');
        $users = User::search($query);


        $users = $users->paginate(config('pagination.users.per_page'));
        $users->load('roles');
        if ($request->isXmlHttpRequest()) {
            return $users;
        }

        return view('dashboard.users.users', compact('users', 'query'));
    }

    public function createView()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    public function create(UserCreateRequest $request)
    {
        return DB::transaction(function () use (&$request) {
            $user = User::create($request->only(['name', 'email', 'password']));
            $user->attachRoles($request->get('roles'));
            $request->session()->flash('user.created', 'Foydalanuvchi yaratildi');
            return redirect()->route('dashboard.users.index');
        });
    }

    public function editView(int $id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('dashboard.users.edit', compact('roles', 'user'));
    }

    public function edit(UserEditRequest $request, int $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->only(['name', 'email', 'password']));
        $user->save();
        $roles = $request->get('roles', []);
        $user->roles()->sync($roles);

        $request->session()->flash('user.edited', "O'zgartirildi");
        return back();
    }

    public function delete(Request $request, int $id)
    {
        User::destroy($id);
        $request->session()->flash('user.deleted', 'Foydalanuvchi o\'chirildi');
        if ($request->isXmlHttpRequest()) {
            return [
                'success' => true
            ];
        }
        return back();
    }
}
