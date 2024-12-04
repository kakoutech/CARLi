<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $builder = User::query();

        if ($request->has('search') && $request->input('search')) {
            $search = '%' . $request->input('search') . '%';

            $builder->where(function ($query) use ($search) {
                return $query->where('first_name', 'LIKE', $search)
                    ->orWhere('last_name', 'LIKE', $search)
                    ->orWhere('email', 'LIKE', $search);
            });
        }

        $users = $builder->paginate(20);

        return view(
            'admin.users.list',
            [
                'users' => $users
            ]
        );
    }

    public function add(Request $request)
    {
        return view('admin.users.add');
    }

    public function edit(Request $request, User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function delete(Request $request, User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with(['success' => 'User Deleted.']);
    }
}
