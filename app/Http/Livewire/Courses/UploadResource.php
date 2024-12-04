<?php

namespace App\Http\Livewire\Courses;

use App\Models\CourseResource;
use App\Models\CourseTopic;
use App\Models\CourseType;
use App\Models\Resource;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadResource extends Component
{
    use WithFileUploads;

    public $file;
    public $course;
    public $type;

    public $rules = [
        'file' => ['required']
    ];

    public function mount($course, $type = null)
    {
        if ($course) {
            $this->course = $course;
        }

        if ($type) {
            $this->type = $type;
        }
    }

    public function updated($property_name)
    {
        if ($property_name == 'file') {
            $this->upload();
        }
    }

    public function upload()
    {
        $this->validate();

        if ($this->file) {
            $document = new Resource();
            $document->type = 'course';
            $document->user_id = auth()->user()->id;
            $document->filename = $this->file->getClientOriginalName();
            $document->extension = $this->file->getClientOriginalExtension();
            $document->size = $this->file->getSize();
            $document->mime = $this->file->getMimeType();
            $document->path = $this->file->store(
                'public/resources/',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
            $document->format = $document->mime;
            $document->save();

            if ($this->course) {
                $this->course->assignResource($this->type, $document);
            }

            $this->emit('close-upload-resource-modal', true);

            if ($this->course) {
                return redirect()->route('dashboard.courses.view', [$this->course->id, 'tab' => $this->type . '-resources'])->with(['success' => 'Resource Added.']);
            }

            return redirect()->route('dashboard.courses.resources')->with(['success' => 'Resource Added']);
        }
    }

    public function render()
    {
        return view('livewire.courses.upload-resource');
    }
}
