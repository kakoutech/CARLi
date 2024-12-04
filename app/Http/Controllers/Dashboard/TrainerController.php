<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('trainers.index'), 403);

        $builder = User::query();

        if (auth()->user()->isEmployer()) {
            $builder->byEmployer(auth()->user()->id);
        }

        $builder->maybePerformSearch($request->input('search'));

        $builder->trainers();

        $builder->latest();

        return view(
            'dashboard.trainers.list',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('trainers.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = User::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.trainers')->with(['success' => $count . ' Items Deleted.']);
    }

    public function deleted(Request $request)
    {
        abort_unless(user()->canView('trainers.deleted'), 403);

        $builder = User::query();

        if (user()->isEmployer()) {
            $builder->byEmployer(user()->id);
        }

        $builder->maybePerformSearch($request->input('search'));

        $builder->trainers();

        $builder->latest();

        $builder->withTrashed();

        $builder->where('deleted_at', '!=', null);

        return view(
            'dashboard.trainers.deleted',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('trainers.add'), 403);

        return view('dashboard.trainers.add');
    }

    public function edit(Request $request, User $user)
    {
        abort_unless(user()->canView('trainers.edit'), 403);

        if (!$user->isTrainer()) {
            return redirect()->route('dashboard.trainers')->with(['success' => 'Trainer not found.']);
        }

        return view('dashboard.trainers.edit', ['user' => $user]);
    }

    public function view(Request $request, User $user)
    {
        abort_unless(user()->canView('trainers.view'), 403);

        if (!$user->isTrainer()) {
            return redirect()->route('dashboard.trainers')->with(['success' => 'Trainer not found.']);
        }

        return view('dashboard.trainers.view', ['user' => $user]);
    }

    public function settings(Request $request)
    {
        abort_unless(user()->canView('trainers.settings'), 403);

        return view('dashboard.trainers.settings');
    }

    public function delete(Request $request, User $user)
    {
        abort_unless(user()->canView('trainers.delete'), 403);

        if (!$user->isTrainer()) {
            return redirect()->route('dashboard.trainers')->with(['success' => 'Trainer not found.']);
        }

        $user->delete();

        return redirect()->route('dashboard.trainers')->with(['success' => 'Trainer Deleted.']);
    }

    public function restore(Request $request, User $user)
    {
        abort_unless(user()->canView('trainers.restore'), 403);

        if (!$user->isTrainer()) {
            return redirect()->route('dashboard.trainers')->with(['success' => 'Trainer not found.']);
        }

        $user->restore();

        return redirect()->route('dashboard.trainers')->with(['success' => 'Trainer Restored.']);
    }
}
