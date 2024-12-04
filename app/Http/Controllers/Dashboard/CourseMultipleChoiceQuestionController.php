<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MultipleChoiceQuestionSet;
use Illuminate\Http\Request;

class CourseMultipleChoiceQuestionController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('courses.mcqs.index'), 403);

        $builder = MultipleChoiceQuestionSet::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->latest();

        return view(
            'dashboard.multiple-choice-questions.list',
            [
                'sets' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('courses.mcqs.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = MultipleChoiceQuestionSet::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.courses.mcqs')->with(['success' => $count . ' Items Deleted.']);
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('courses.mcqs.add'), 403);

        return view('dashboard.multiple-choice-questions.add');
    }

    public function edit(Request $request, MultipleChoiceQuestionSet $multiple_choice_question_set)
    {
        abort_unless(user()->canView('courses.mcqs.edit'), 403);

        return view('dashboard.multiple-choice-questions.edit', ['set' => $multiple_choice_question_set]);
    }

    public function view(Request $request, MultipleChoiceQuestionSet $multiple_choice_question_set)
    {
        abort_unless(user()->canView('courses.mcqs.view'), 403);

        return view('dashboard.multiple-choice-questions.view', ['set' => $multiple_choice_question_set]);
    }

    public function delete(Request $request, MultipleChoiceQuestionSet $multiple_choice_question_set)
    {
        abort_unless(user()->canView('courses.mcqs.delete'), 403);

        $multiple_choice_question_set->delete();

        return redirect()->route('dashboard.courses.mcqs')->with(['success' => 'Question Set Deleted.']);
    }
}
