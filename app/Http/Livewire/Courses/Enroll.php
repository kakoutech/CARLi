<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use App\Models\CourseTopic;
use App\Models\CourseType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Enroll extends Component
{
    public $parent;
    public $course_id;
    public $student_id;

    public $rules = [
        'student_id' => ['required'],
        'course_id' => ['required']
    ];

    public function mount($parent, $course = null)
    {
        $this->parent = $parent;

        if ($course) {
            $this->course_id = $course->id;
        }
    }

    public function enroll()
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

        $course->enrollLearner($learner);

        return redirect($this->parent)->with(['success' => 'Learner Enrolled']);
    }

    public function render()
    {
        return view(
            'livewire.courses.enroll',
            [
                'learners' => getLearners(),
                'courses' => Course::query()->orderBy('title', 'ASC')->get()
            ]
        );
    }
}
