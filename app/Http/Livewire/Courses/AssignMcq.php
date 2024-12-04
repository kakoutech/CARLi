<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use App\Models\MultipleChoiceQuestionSet;
use App\Models\User;
use App\Notifications\MCQAssigned;
use Livewire\Component;

class AssignMcq extends Component
{
    public $course;
    public $course_id;
    public $student_id;
    public $multiple_choice_question_set_id;
    public $date;
    public $time;

    public $rules = [
        'course_id' => ['required'],
        'student_id' => ['required'],
        'multiple_choice_question_set_id' => ['required'],
        'date' => ['required'],
        'time' => ['required']
    ];

    public $listeners = [
        'setStudentId'
    ];

    public function mount($course = null)
    {
        $this->course = $course;
        $this->course_id = $course->id;
    }

    public function setStudentId($student_id)
    {
        $this->student_id = $student_id;
    }

    public function assign()
    {
        $this->validate();

        $learner = User::find($this->student_id);
        if (!$learner) {
            $this->addError('student_id', 'You must select a valid learner.');
            return;
        }

        $course = Course::find($this->course_id);
        if (!$course) {
            $this->addError('course_id', 'You must select a valid course.');
            return;
        }

        $mcq = MultipleChoiceQuestionSet::find($this->multiple_choice_question_set_id);
        if (!$mcq) {
            $this->addError('multiple_choice_question_set_id', 'You must select a valid MCQ.');
            return;
        }

        $learner_mcq = $course->assignQuestionSet($learner, $mcq, $this->date, $this->time, auth()->user());

        $learner->notify(new MCQAssigned($learner_mcq));

        return redirect()->route('dashboard.courses.view', [$course->id, 'tab' => 'mcqs'])->with(['success' => 'MCQ assigned to ' . $learner->getFullName()]);
    }

    public function render()
    {
        return view(
            'livewire.courses.assign-mcq',
            [
                'students' => $this->course->enrolled,
                //'multiple_choice_question_sets' => $this->course->multipleChoiceQuestionSets
                'multiple_choice_question_sets' => MultipleChoiceQuestionSet::all()
            ]
        );
    }
}
