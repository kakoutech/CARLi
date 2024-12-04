<?php

namespace App\Http\Livewire\VirtualClasses;

use App\Models\VirtualClass;
use App\Models\VirtualClassAttachment;
use App\Models\VirtualClassAttendee;
use App\Models\VirtualClassCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageClass extends Component
{
    use WithFileUploads;

    public $thumbnail_file;
    public $class;
    public $edit_class;

    public $rules = [
        'thumbnail_file' => [],
        'edit_class.title' => ['required'],
        'edit_class.duration' => ['required'],
        'edit_class.description' => [],
        'edit_class.virtual_class_category_id' => ['required', 'exists:virtual_class_categories,id'],
        'edit_class.trainer_id' => ['required'],
        'edit_class.view_scope' => ['required'],
        'edit_class.active' => ['required'],
        'edit_class.class_type' => ['required'],
        'edit_class.language_id' => ['required', 'exists:languages,id'],
        'edit_class.trainer_password' => [],
        'edit_class.attendee_password' => [],
        'edit_class.recurrence' => [],
        'edit_class.start_date' => ['required'],
        'edit_class.start_time' => ['required'],
        'edit_class.host' => ['required'],
        'edit_class.recurs_for' => [],
    ];

    public function mount($class)
    {
        $this->class = $class;

        if (!$this->class) {
            $this->class = new VirtualClass();
            $this->class->view_scope = 0;
        }

        $this->edit_class = $this->class;
    }

    public function save()
    {
        $this->validate();

        if ($this->thumbnail_file) {
            $this->edit_class->thumbnail_path = $this->thumbnail_file->store(
                'public/media/virtual-classes',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->edit_class->save();

        return redirect()->route('dashboard.virtual-classes.edit', [$this->edit_class->id])->with(['success' => 'Virtual Class Updated.']);
    }

    public function render()
    {
        return view(
            'livewire.virtual-classes.manage-class',
            [
                'categories' => VirtualClassCategory::all()
            ]
        );
    }
}
