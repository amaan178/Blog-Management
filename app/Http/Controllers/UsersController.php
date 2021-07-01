<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact(['users']));
    }


    public function makeAdmin(User $user)
    {
        $user->update(['role' => User::ADMIN]);
        session()->flash('success', $user->name . ' has been assigned admin role!');
        return redirect(route('users.index'));
    }

    public function revokeAdmin(User $user)
    {
        $user->update(['role' => User::AUTHOR]);
        session()->flash('success', $user->name . ' has been revoked from admin role!');
        return redirect(route('users.index'));
    }
}
