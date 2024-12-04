<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Assessment as AssessmentModel;
use App\Models\AssessmentResponse;
use Livewire\Component;

class Assessment extends Component
{
    public $assessment_item;
    public $current_group;
    public $current_question;
    public $response_item;
    public $total_groups;
    public $total_questions;
    public $is_complete;
    public $readonly;

    public $rules = [
        'assessment_item.groups.*.statements.*.user_response' => ['required']
    ];

    public function mount(AssessmentModel $assessment, $assessment_response = null, $readonly = false)
    {
        $this->assessment_item = $assessment;
        $this->current_group = 1;
        $this->readonly = $readonly;

        $this->total_groups = $this->assessment_item->groups->count();
        $this->total_questions = 0;

        if ($assessment_response) {
            $this->response_item = $assessment_response;
            $this->is_complete = true;
            $this->current_group = $this->total_groups + 1;
        } else {
            $this->response_item = AssessmentResponse::where('user_id', '=', auth()->user()->id)->where('assessment_id', '=', $this->assessment_item->id)->where('completed_at', '=', null)->first();
        }

        if ($this->readonly) {
            $this->current_group = 1;
            $this->current_question = 1;
        }

        foreach ($this->assessment_item->groups as $group) {
            $this->total_questions = $this->total_questions + $group->statements()->count();
        }

        $this->total_groups = $this->total_questions;

        if ($this->response_item) {
            foreach ($this->assessment_item->groups as &$groups) {
                foreach ($groups->statements as &$statement) {
                    $statement->user_response = $this->response_item->fetchResponse($statement);
                }
            }
        }
    }

    public function nextStep()
    {
        if (!$this->readonly) {
            if ($this->total_questions == $this->current_question) {
                $this->is_complete = true;
                if ($this->response_item && !$this->response_item->completed_at) {
                    $this->response_item->markAsCompleted();
                }
            }
        }

        $this->current_question++;

        $this->current_group = 100 - (($this->total_questions - $this->current_question) / $this->total_questions) * 100;
        //$this->current_group++;
        $this->emit('refresh-carousel');
    }

    public function prevStep()
    {
        $this->current_question--;
        //$this->current_group--;
        $this->current_group = 100 - (($this->total_questions - $this->current_question) / $this->total_questions) * 100;

        $this->emit('refresh-carousel');
    }

    public function updated()
    {

        $this->emit('refresh-carousel');
    }

    public function saveStep()
    {
        if (!$this->readonly) {
            if (!$this->response_item) {
                $response_item = new AssessmentResponse();
                $response_item->user_id = auth()->user()->id;
                $response_item->assessment_id = $this->assessment_item->id;
                $response_item->save();

                $this->response_item = $response_item;
            }

            foreach ($this->assessment_item->groups as $group) {
                foreach ($group->statements as $statement) {
                    if ($statement->user_response) {
                        $this->response_item->recordResult($statement, $statement->user_response);
                    }
                }
            }
        }

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.frontend.assessment');
    }
}
