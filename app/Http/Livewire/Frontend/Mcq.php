<?php

namespace App\Http\Livewire\Frontend;

use App\Models\MultipleChoiceQuestionSet;
use App\Models\AssessmentResponse;
use App\Models\UserCourseMultipleChoiceQuestionSet;
use Livewire\Component;

class Mcq extends Component
{
    public $set;
    public $response_item;
    public $total_questions;
    public $is_complete;
    public $current_question;
    public $readonly;

    public $rules = [
        'set.mcq.questions.*.user_response' => ['required']
    ];

    public function mount(UserCourseMultipleChoiceQuestionSet $set, $readonly = false)
    {
        $this->set = $set;
        $this->total_questions = $this->set->mcq->questions->count();
        $this->current_question = 1;
        $this->is_complete = $this->set->is_complete;
        $this->readonly = $readonly;

        if (!$this->readonly && $this->is_complete) {
            $this->current_question = $this->total_questions + 1;
        }

        foreach ($this->set->mcq->questions as &$question) {
            $question->user_response = $this->set->fetchResponse($question);
        }
    }

    public function nextStep()
    {
        if (!$this->readonly) {
            if ($this->total_questions == $this->current_question) {
                $this->is_complete = true;
                if ($this->set && !$this->set->completed_at) {
                    $this->set->markAsCompleted();
                }
            }
        }

        $this->current_question++;
    }

    public function prevStep()
    {
        $this->current_question--;
    }

    public function saveStep()
    {
        if (!$this->readonly) {
            foreach ($this->set->mcq->questions as $question) {
                $this->set->recordResult($question, $question->user_response);
            }
        }

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.frontend.mcq');
    }
}
