<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ReflectiveJournalEntry;
use App\Models\ReflectiveJournalStep;
use App\Models\UserCertificate;
use App\Models\Assessment;
use App\Models\AssessmentResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function courses(Request $request)
    {
        abort_unless(user()->isLearner(), 403);

        $builder = auth()->user()->enrolled();

        return view(
            'dashboard.profile.courses',
            [
                'courses' => $builder->paginate(25)
            ]
        );
    }

    public function viewCourse(Request $request, $course_enroll_id)
    {
        abort_unless(user()->isLearner(), 403);

        $course_enroll = user()->enrolled()->find($course_enroll_id);

        abort_unless($course_enroll, 403);

        return view(
            'dashboard.profile.course-view',
            [
                'course' => $course_enroll
            ]
        );
    }

    public function assessmentHub(Request $request)
    {
        return view('dashboard.profile.assessment-hub');
    }

    public function assessments(Request $request)
    {
        return view('dashboard.profile.assessments');
    }

    public function takeAssessment(Request $request, Assessment $assessment)
    {
        abort_unless($assessment->isActive(), 404);

        return view('dashboard.profile.assessment', ['assessment' => $assessment]);
    }

    public function reviewAssessment(Request $request, Assessment $assessment, AssessmentResponse $assessment_response)
    {
        abort_unless($assessment->isActive(), 404);

        return view('dashboard.profile.assessment-marking', ['assessment' => $assessment, 'assessment_response' => $assessment_response]);
    }

    public function mcqs(Request $request)
    {
        abort_unless(user()->isLearner(), 403);

        $builder = auth()->user()->userMcqs();

        return view(
            'dashboard.profile.mcqs',
            [
                'mcqs' => $builder->paginate(25)
            ]
        );
    }

    public function viewMcq(Request $request, $mcq_id)
    {
        abort_unless(user()->isLearner(), 403);

        $mcq = user()->userMcqs()->find($mcq_id);

        abort_unless($mcq, 403);

        return view(
            'dashboard.profile.mcq-view',
            [
                'mcq' => $mcq
            ]
        );
    }

    public function classes(Request $request)
    {
        abort_unless(user()->isLearner(), 403);

        $builder = auth()->user()->virtualClasses();

        $builder->leftJoin('virtual_classes', 'virtual_classes.id', '=', 'virtual_class_attendees.virtual_class_id');

        $builder->orderBy('virtual_classes.start_date', 'ASC')
            ->orderBy('virtual_classes.start_time', 'DESC');

        $builder->select('virtual_class_attendees.*')->where('virtual_classes.start_date',  '>', now());

        return view(
            'dashboard.profile.classes',
            [
                'classes' => $builder->paginate(25)
            ]
        );
    }

    public function viewClass(Request $request, $virtual_class_id)
    {
        abort_unless(user()->isLearner(), 403);

        $virtual_class = auth()->user()->virtualClasses()->find($virtual_class_id);

        abort_unless($virtual_class, 403);

        return view(
            'dashboard.profile.class-view',
            [
                'class' => $virtual_class
            ]
        );
    }

    public function certificates(Request $request)
    {
        abort_unless(user()->isLearner(), 403);

        $builder = auth()->user()->certificates();

        $builder->latest();

        return view(
            'dashboard.profile.certificates',
            [
                'certificates' => $builder->paginate(25)
            ]
        );
    }

    public function viewCertificate(Request $request, UserCertificate $user_certificate)
    {
        abort_unless(user()->isLearner(), 403);

        abort_unless(user()->id == $user_certificate->user_id, 403);

        // Send headers
        //header("Content-Type: application/pdf");
        //header("Pragma: public");
        //header("Expires: 0");
        //header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        //header("Content-Type: application/force-download");
        //header("Content-Type: application/octet-stream");
        //header("Content-Type: application/download");
        //header('Content-Disposition: attachment; filename="certificate.pdf"');
        //header("Content-Transfer-Encoding: binary ");
        //echo $user_certificate->pdf()->stream();
        //exit;

        return view(
            'dashboard.certificates.partials.pdf',
            [
                'user_certificate' => $user_certificate,
                'data' => json_decode($user_certificate->certificate_data, true)
            ]
        );
    }

    public function badges(Request $request)
    {
        abort_unless(user()->isLearner(), 403);

        $builder = auth()->user()->badges();

        $builder->latest();

        return view(
            'dashboard.profile.badges',
            [
                'badges' => $builder->paginate(25)
            ]
        );
    }

    public function reflectiveJournal(Request $request)
    {
        abort_unless(user()->isLearner(), 403);

        $builder = auth()->user()->journals();

        $builder->latest();

        return view(
            'dashboard.profile.journals',
            [
                'entries' => $builder->paginate(25)
            ]
        );
    }

    public function newReflectiveJournal(Request $request)
    {
        abort_unless(user()->isLearner(), 403);

        $journal_steps = ReflectiveJournalStep::orderBy('order')->get();
        $journal_record = ReflectiveJournalEntry::where('user_id', '=', auth()->user()->id)->where('completed_at', '=', null)->orderBy('created_at', 'DESC')->first();
        if (!$journal_record) {
            $journal_record = new ReflectiveJournalEntry();
            $journal_record->user_id = auth()->user()->id;
            $journal_record->save();
        }

        return view(
            'dashboard.profile.journal-new',
            [
                'journal_steps' => $journal_steps,
                'journal_entry' => $journal_record,
            ]
        );
    }
    public function viewReflectiveJournal(Request $request, ReflectiveJournalEntry $reflective_journal_entry)
    {
        abort_unless(user()->isLearner(), 403);

        abort_unless(auth()->user()->id == $reflective_journal_entry->user_id, 403);

        $journal_steps = ReflectiveJournalStep::orderBy('order')->get();

        return view(
            'dashboard.profile.journal-view',
            [
                'journal_steps' => $journal_steps,
                'journal_entry' => $reflective_journal_entry,
            ]
        );
    }
}
