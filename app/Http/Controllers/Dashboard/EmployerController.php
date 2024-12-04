<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('employers.index'), 403);

        $builder = User::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->employers();

        $builder->latest();

        return view(
            'dashboard.employers.list',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('employers.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = User::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.employers')->with(['success' => $count . ' Items Deleted.']);
    }

    public function deleted(Request $request)
    {
        abort_unless(user()->canView('employers.deleted'), 403);

        $builder = User::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->employers();

        $builder->latest();

        $builder->withTrashed();

        $builder->where('deleted_at', '!=', null);

        return view(
            'dashboard.employers.deleted',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('employers.add'), 403);

        return view('dashboard.employers.add');
    }

    public function edit(Request $request, User $user)
    {
        abort_unless(user()->canView('employers.edit'), 403);

        if (!$user->isEmployer()) {
            return redirect()->route('dashboard.employers')->with(['success' => 'Employer not found.']);
        }

        return view('dashboard.employers.edit', ['user' => $user]);
    }

    public function view(Request $request, User $user)
    {
        abort_unless(user()->canView('employers.view'), 403);

        if (!$user->isEmployer()) {
            return redirect()->route('dashboard.employers')->with(['success' => 'Employer not found.']);
        }

        return view('dashboard.employers.view', ['user' => $user]);
    }

    public function settings(Request $request)
    {
        abort_unless(user()->canView('employers.settings'), 403);

        return view('dashboard.employers.settings');
    }

    public function delete(Request $request, User $user)
    {
        abort_unless(user()->canView('employers.delete'), 403);

        if (!$user->isEmployer()) {
            return redirect()->route('dashboard.employers')->with(['success' => 'Employer not found.']);
        }

        $user->delete();

        return redirect()->route('dashboard.employers')->with(['success' => 'Employer Deleted.']);
    }

    public function restore(Request $request, User $user)
    {
        abort_unless(user()->canView('employers.restore'), 403);

        if (!$user->isEmployer()) {
            return redirect()->route('dashboard.employers')->with(['success' => 'Employer not found.']);
        }

        $user->restore();

        return redirect()->route('dashboard.employers')->with(['success' => 'Employer Restored.']);
    }
}
