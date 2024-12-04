<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use App\Models\CourseTopic;
use App\Models\CourseType;
use App\Models\Resource;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssignResource extends Component
{
    public $parent;
    public $course_id;
    public $resource_id;
    public $type;

    public $rules = [
        'resource_id' => ['required'],
        'course_id' => ['required'],
        'type' => ['required'],
    ];

    public function mount($parent, $course = null, $type = 'read')
    {
        $this->parent = $parent;

        if ($course) {
            $this->course_id = $course->id;
        }

        if ($type) {
            $this->type = $type;
        }
    }

    public function types()
    {
        return ['Read', 'Listen', 'Watch'];
    }

    public function assign()
    {
        $this->validate();

        $resource = Resource::find($this->resource_id);
        if (!$resource) {
            $this->addError('resource_id', 'You must select a valid resource.');
            return;
        }

        $course = Course::find($this->course_id);
        if (!$course) {
            $this->addError('course_id', 'You must select a valid course.');
            return;
        }

        $course->assignResource($this->type, $resource);

        return redirect($this->parent)->with(['success' => 'Resource Assigned.']);
    }

    public function render()
    {
        return view(
            'livewire.courses.assign-resource',
            [
                'resources' => Resource::query()->get(),
                'courses' => Course::query()->get(),
                'types' => $this->types()
            ]
        );
    }
}
