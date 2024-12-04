<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use App\Models\CourseTopic;
use App\Models\CourseType;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCourse extends Component
{
    use WithFileUploads;

    public $thumbnail_file;
    public $course;
    public $edit_course;

    public $rules = [
        'thumbnail_file' => [],
        'edit_course.title' => ['required'],
        'edit_course.duration' => [],
        'edit_course.description' => [],
        'edit_course.course_type_id' => ['required'],
        'edit_course.course_topic_id' => ['required'],
        'edit_course.trainer_id' => ['required'],
        'edit_course.view_scope' => ['required'],
        'edit_course.active' => ['required'],
    ];

    public function mount($course)
    {
        $this->course = $course;

        if (!$this->course) {
            $this->course = new Course();
            $this->course->view_scope = 0;
        }

        $this->edit_course = $this->course;
    }

    public function save()
    {
        $this->validate();

        if ($this->thumbnail_file) {
            $this->edit_course->thumbnail_path = $this->thumbnail_file->store(
                'public/media/courses',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->edit_course->save();

        return redirect()->route('dashboard.courses.edit', [$this->edit_course->id])->with(['success' => 'Course Updated.']);
    }

    public function render()
    {
        return view(
            'livewire.courses.manage-course',
            [
                'topics' => CourseTopic::all(),
                'types' => CourseType::all(),
            ]
        );
    }
}
