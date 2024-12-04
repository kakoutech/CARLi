<?php

namespace App\Http\Livewire\Frontend;

use App\Models\ReflectiveJournalEntry;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class ReflectiveJournal extends Component
{
    use WithFileUploads;

    public $file;
    public $audio;
    public $user;
    public $steps;
    public $entry;
    public $current_step;
    public $step_entry;
    public $show_record;
    public $trainer_responses = [];
    public $trainer_responses_sent = false;

    public $rules = [
        'audio' => [],
        'file' => [],
        'trainer_responses' => [],
        'step_entry.response' => ['required'],
    ];

    public function mount($user, $steps, $entry)
    {
        $this->user = $user;
        $this->steps = $steps;
        $this->entry = $entry;

        $this->setupSteps();
    }

    public function showRecord()
    {
        $this->show_record = 1;
    }

    public function stepEntry()
    {
        $this->step_entry = $this->entry->getResponse($this->steps[$this->current_step-1]);
    }

    public function setupSteps()
    {
        $this->current_step = 1;
        $this->stepEntry();
    }

    public function goBack()
    {
        $this->current_step--;

        $this->stepEntry();
    }

    public function goForward()
    {
        $this->current_step++;

        if ($this->current_step <= count($this->steps)) {

            $this->stepEntry();

        } else {
            
            $this->entry->completed_at = now();
            
            $this->entry->save();

        }
    }

    public function sendToTrainer()
    {
        $response_ids = [];

        foreach ($this->trainer_responses as $response) {
            $response_ids[] = $response;
        }

        array_unique($response_ids);

        if ($response_ids) {
            $trainer = auth()->user()->trainer;

            if ($trainer) {
                $entries = $this->entry->responses()->whereIn('id', $response_ids)->get();
                if ($entries) {
                    $trainer->sendReflectionJournalSubmission(auth()->user(), $entries);
                }
            }
        }

        $this->trainer_responses_sent = true;
    }

    public function saveStep()
    {
        $this->validate();
        
        if ($this->audio) {
            $contents = base64_decode($this->audio);
            $filename = Str::random(40) . '-' . time() . '.mp3';
            $path = 'journal/recording/' . $this->step_entry->id  . '/' . $filename;
            Storage::put($path, $contents);
            $this->step_entry->audio = $path;
        }

        if ($this->file) {
            $this->step_entry->file = $this->file->store(
                'journal/files/' . $this->step_entry->id,
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->step_entry->save();

        $this->file = null;
        $this->show_record = false;

        $this->goForward();
    }

    public function render()
    {
        return view('livewire.frontend.reflective-journal');
    }
}
