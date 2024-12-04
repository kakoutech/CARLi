<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('assessments.index'), 403);

        $builder = Assessment::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->latest();

        return view(
            'dashboard.assessments.list',
            [
                'assessments' => $builder->paginate(25),
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('assessments.add'), 403);

        return view('dashboard.assessments.add');
    }

    public function edit(Request $request, Assessment $assessment)
    {
        abort_unless(user()->canView('assessments.edit'), 403);

        return view('dashboard.assessments.edit', [
            'assessment' => $assessment
        ]);
    }

    public function view(Request $request, Assessment $assessment)
    {
        abort_unless(user()->canView('assessments.view'), 403);

        return view('dashboard.assessments.view', ['assessment' => $assessment]);
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('assessments.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = Assessment::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.assessments')->with(['success' => $count . ' Items Deleted.']);
    }

    public function delete(Request $request, Assessment $assessment)
    {
        abort_unless(user()->canView('assessments.delete'), 403);

        $assessment->delete();

        return redirect()->route('dashboard.assessments')->with(['success' => 'Assessment Deleted.']);
    }
}
