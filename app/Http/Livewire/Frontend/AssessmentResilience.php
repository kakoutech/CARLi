<?php

namespace App\Http\Livewire\Frontend;

use App\Models\AssessmentResilience as AssessmentResilienceModel;
use Livewire\Component;

class AssessmentResilience extends Component
{
    public $questions;
    public $current_question;

    public $rules = [
        'questions.*.statements.*.result' => ['required']
    ];

    public function mount()
    {
        $this->questions = AssessmentResilienceModel::all();

        foreach ($this->questions as $question) {
            foreach ($question->statements as $statement) {
                $score = $statement->result(auth()->user());
                if ($score) {
                    $statement->result = $score->answer;
                }
            }
        }

        $this->current_question = 1;
    }

    public function nextStep()
    {
        $this->current_question++;
    }

    public function prevStep()
    {
        $this->current_question--;
    }

    public function saveStep()
    {
        foreach ($this->questions as $question) {
            foreach ($question->statements as $statement) {
                if ($statement->result) {
                    $statement->recordResult(auth()->user());
                }
            }
        }

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.frontend.assessment-resilience');
    }
}
