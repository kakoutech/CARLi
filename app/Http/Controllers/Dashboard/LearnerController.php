<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AssessmentResponse;
use App\Models\ReflectiveJournalEntry;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UserCourseMultipleChoiceQuestionSet;
use Illuminate\Http\Request;

class LearnerController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('learners.index'), 403);

        $builder = User::query();

        $builder->maybePerformSearch($request->input('search'));

        if (auth()->user()->isEmployer()) {
            $builder->where('employer_id', '=', auth()->user()->id);
        }

        if (auth()->user()->isTrainer()) {
            $builder->where('trainer_id', '=', auth()->user()->id);
        }

        $builder->learners();

        $builder->orderBy('first_name', 'ASC');

        return view(
            'dashboard.learners.list',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('learners.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = User::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.learners')->with(['success' => $count . ' Items Deleted.']);
    }

    public function deleted(Request $request)
    {
        abort_unless(user()->canView('learners.deleted'), 403);

        $builder = User::query();

        $builder->maybePerformSearch($request->input('search'));

        if (auth()->user()->isEmployer()) {
            $builder->where('employer_id', '=', auth()->user()->id);
        }

        if (auth()->user()->isTrainer()) {
            $builder->where('trainer_id', '=', auth()->user()->id);
        }

        $builder->learners();

        $builder->latest();

        $builder->withTrashed();

        $builder->where('deleted_at', '!=', null);

        return view(
            'dashboard.learners.deleted',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function enrolled(Request $request)
    {
        abort_unless(user()->canView('learners.enrolled'), 403);

        $builder = User::query();

        $builder->maybePerformSearch($request->input('search'));

        if (auth()->user()->isEmployer()) {
            $builder->where('employer_id', '=', auth()->user()->id);
        }

        if (auth()->user()->isTrainer()) {
            $builder->where('trainer_id', '=', auth()->user()->id);
        }

        $builder->learners();

        $builder->latest();

        return view(
            'dashboard.learners.enrolled',
            [
                'users' => $builder->paginate(25)
            ]
        );
    }

    public function newEnroll(Request $request)
    {
        abort_unless(user()->canView('learners.new-enroll'), 403);

        return view('dashboard.learners.enroll');
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('learners.add'), 403);

        return view('dashboard.learners.add');
    }

    public function edit(Request $request, User $user)
    {
        abort_unless(user()->canView('learners.edit'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        return view('dashboard.learners.edit', ['user' => $user]);
    }

    public function viewJournalResponse(Request $request, User $user, ReflectiveJournalEntry $reflective_journal_entry)
    {
        abort_unless(user()->canView('learners.view'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        return view('dashboard.learners.view-journal-response', ['user' => $user, 'entry' => $reflective_journal_entry]);
    }

    public function view(Request $request, User $user)
    {
        abort_unless(user()->canView('learners.view'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        return view('dashboard.learners.view', ['user' => $user]);
    }

    public function viewCertificate(Request $request, User $user, UserCertificate $user_certificate)
    {
        abort_unless(user()->canView('learners.view-certificate'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        return view('dashboard.certificates.partials.pdf', ['user_certificate' => $user_certificate]);
    }

    public function viewMcqResult(Request $request, User $user, UserCourseMultipleChoiceQuestionSet $user_mcq)
    {
        abort_unless(user()->canView('learners.view'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        return view('dashboard.learners.view-mcq-result', ['user' => $user, 'mcq' => $user_mcq]);
    }

    public function cancelMcq(Request $request, User $user, UserCourseMultipleChoiceQuestionSet $user_mcq)
    {
        abort_unless(user()->canView('learners.view'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        $user_mcq->delete();

        return redirect()->route('dashboard.learners.view', [$user->id, 'tab' => 'mcqs'])->with(['success' => 'MCQ Cancelled.']);
    }

    public function viewAssessmentResult(Request $request, User $user, AssessmentResponse $assessment_response)
    {
        abort_unless(user()->canView('learners.view'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        return view('dashboard.learners.view-assessment-result', ['user' => $user, 'assessment_response' => $assessment_response]);
    }

    public function settings(Request $request)
    {
        abort_unless(user()->canView('learners.settings'), 403);

        return view('dashboard.learners.settings');
    }

    public function delete(Request $request, User $user)
    {
        abort_unless(user()->canView('learners.delete'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        $user->delete();

        return redirect()->route('dashboard.learners')->with(['success' => 'Learner Deleted.']);
    }

    public function restore(Request $request, User $user)
    {
        abort_unless(user()->canView('learners.restore'), 403);

        if (!$user->isLearner()) {
            return redirect()->route('dashboard.learners')->with(['success' => 'Learner not found.']);
        }

        $user->restore();

        return redirect()->route('dashboard.learners')->with(['success' => 'Learner Restored.']);
    }
}
