<?php

namespace App\Http\Livewire\Admin\ReflectiveJournalSteps;

use App\Models\ReflectiveJournalStep;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;

    public $step;
    public $edit_step;
    public $file;

    public $rules = [
        'file' => [],
        'edit_step.title' => ['required'],
        'edit_step.active' => ['required'],
        'edit_step.content' => ['required'],
        'edit_step.order' => ['required'],
        'edit_step.accept_input' => ['required'],
    ];

    public function mount($step)
    {
        $this->step = $step;

        if (!$this->step) {
            $this->step = new ReflectiveJournalStep();
            $order = ReflectiveJournalStep::orderBy('order', 'DESC')->first();
            if ($order) {
                $order = $order->order + 1;
            } else {
                $order = 1;
            }
            $this->step->order = $order;

        }

        $this->edit_step = $this->step;
    }

    public function save()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->validate();

        if ($this->file) {
            $this->edit_step->uploads = $this->file->store(
                'public/media/reflective-journal',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->edit_step->save();

        return redirect()->route('admin.reflective-journal.edit', [$this->edit_step->id])->with(['success' => 'Reflective Journal Step Updated.']);
    }

    public function render()
    {
        return view(
            'livewire.admin.reflective-journal-steps.manage',
            [
            ]
        );
    }
}
