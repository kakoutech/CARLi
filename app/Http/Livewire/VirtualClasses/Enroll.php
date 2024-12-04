<?php

namespace App\Http\Livewire\VirtualClasses;

use App\Models\VirtualClass;
use App\Models\User;
use Livewire\Component;

class Enroll extends Component
{
    public $parent;
    public $virtual_class_id;
    public $student_id;

    public $rules = [
        'student_id' => ['required'],
        'virtual_class_id' => ['required']
    ];

    public function mount($parent, $virtual_class = null)
    {
        $this->parent = $parent;

        if ($virtual_class) {
            $this->virtual_class_id = $virtual_class->id;
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

        $virtual_class = VirtualClass::find($this->virtual_class_id);
        if (!$virtual_class) {
            $this->addError('virtual_class_id', 'You must select a valid virtual class.');
            return;
        }

        $virtual_class->enrollLearner($learner);

        return redirect($this->parent)->with(['success' => 'Learner Enrolled']);
    }

    public function render()
    {
        return view(
            'livewire.virtual-classes.enroll',
            [
                'learners' => getLearners(),
                'virtual_classes' => VirtualClass::query()->orderBy('title', 'ASC')->get()
            ]
        );
    }
}
