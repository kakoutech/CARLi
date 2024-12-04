<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('super-admins.index'), 403);

        $builder = User::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->superadmins();

        $builder->latest();

        return view(
            'dashboard.super-admins.list',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('super-admins.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = User::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.super-admins')->with(['success' => $count . ' Items Deleted.']);
    }

    public function deleted(Request $request)
    {
        abort_unless(user()->canView('super-admins.deleted'), 403);

        $builder = User::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->superadmins();

        $builder->latest();

        $builder->withTrashed();

        $builder->where('deleted_at', '!=', null);

        return view(
            'dashboard.super-admins.deleted',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('super-admins.add'), 403);

        return view('dashboard.super-admins.add');
    }

    public function edit(Request $request, User $user)
    {
        abort_unless(user()->canView('super-admins.edit'), 403);

        if (!$user->isSuperAdmin()) {
            return redirect()->route('dashboard.super-admins')->with(['success' => 'Super-Admin not found.']);
        }

        return view('dashboard.super-admins.edit', ['user' => $user]);
    }

    public function view(Request $request, User $user)
    {
        abort_unless(user()->canView('super-admins.view'), 403);

        if (!$user->isSuperAdmin()) {
            return redirect()->route('dashboard.super-admins')->with(['success' => 'Super-Admin not found.']);
        }

        return view('dashboard.super-admins.view', ['user' => $user]);
    }

    public function settings(Request $request)
    {
        abort_unless(user()->canView('super-admins.settings'), 403);

        return view('dashboard.super-admins.settings');
    }

    public function delete(Request $request, User $user)
    {
        abort_unless(user()->canView('super-admins.delete'), 403);

        if (!$user->isSuperAdmin()) {
            return redirect()->route('dashboard.super-admins')->with(['success' => 'Super-Admin not found.']);
        }

        $user->delete();

        return redirect()->route('dashboard.super-admins')->with(['success' => 'SuperAdmin Deleted.']);
    }

    public function restore(Request $request, User $user)
    {
        abort_unless(user()->canView('super-admins.restore'), 403);

        if (!$user->isSuperAdmin()) {
            return redirect()->route('dashboard.super-admins')->with(['success' => 'Super-Admin not found.']);
        }

        $user->restore();

        return redirect()->route('dashboard.super-admins')->with(['success' => 'Super Admin Restored.']);
    }
}
