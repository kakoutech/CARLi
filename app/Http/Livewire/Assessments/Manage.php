<?php

namespace App\Http\Livewire\Assessments;

use App\Models\Assessment;
use App\Models\AssessmentGroup;
use App\Models\AssessmentGroupMarking;
use App\Models\AssessmentStatement;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;

    public $assessment;

    public $groups;

    public $image_file;

    public $image_path;

    public $rules = [
        'image_file' => [],
        'assessment.name' => ['required'],
        'assessment.description' => ['required'],
    ];

    public function mount($assessment)
    {
        $this->assessment = $assessment;
        $this->image_path = $assessment ? $assessment->getImage() : null;

        if (! $this->assessment) {
            $this->assessment = new Assessment();
            $this->assessment->scale = 5;
            $this->addGroup();
            $this->addStatement(0);
            $this->addScoring(0);
        } else {
            $this->groups = [];
            foreach ($this->assessment->groups as $_group) {
                $group = $_group->toArray();
                $group['statements'] = $_group->statements->toArray();
                $group['markings'] = $_group->markings->toArray();
                $this->groups[] = $group;
            }
        }
    }

    public function addGroup()
    {
        $group = [
            'id' => null,
            'name' => '',
            'slug' => null,
            'statements' => [],
            'markings' => [],
        ];

        $this->groups[] = $group;
    }

    public function addStatement($group_index)
    {
        $statement = [
            'id' => null,
            'statement' => '',
            'scale' => 5,
            'scale_1_text' => '',
            'scale_1_explanation' => '',
            'scale_1' => '',
            'scale_2_text' => '',
            'scale_2_explanation' => '',
            'scale_2' => '',
            'scale_3_text' => '',
            'scale_3_explanation' => '',
            'scale_3' => '',
            'scale_4_text' => '',
            'scale_4_explanation' => '',
            'scale_4' => '',
            'scale_5_text' => '',
            'scale_5_explanation' => '',
            'scale_5' => '',
            'scale_6_text' => '',
            'scale_6_explanation' => '',
            'scale_6' => '',
            'scale_7_text' => '',
            'scale_7_explanation' => '',
            'scale_7' => '',
            'scale_8_text' => '',
            'scale_8_explanation' => '',
            'scale_8' => '',
            'scale_9_text' => '',
            'scale_9_explanation' => '',
            'scale_9' => '',
            'scale_10_text' => '',
            'scale_10explanationt' => '',
            'scale_10' => '',
        ];

        $this->groups[$group_index]['statements'][] = $statement;
    }

    public function addScoring($group_index)
    {
        $marking = [
            'id' => null,
            'score_from' => '',
            'score_to' => '',
            'name' => '',
            'pre_explanation' => '',
            'post_explanation' => '',
        ];

        $this->groups[$group_index]['markings'][] = $marking;
    }

    public function deleteScoring($group_index, $marking_index)
    {
        unset($this->groups[$group_index]['markings'][$marking_index]);
    }

    public function save()
    {
        $this->validate();

        if ($this->image_file) {
            $this->assessment->image_path = $this->image_file->store(
                'public/assets/assessments',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public',
                ]
            );
        }

        $this->image_path = $this->assessment->getImage();

        $this->assessment->save();

        foreach ($this->groups as $_group) {
            $group = null;
            if ($_group['id']) {
                $group = AssessmentGroup::find($_group['id']);
            }

            if (! $group) {
                $group = new AssessmentGroup();
            }

            $group->assessment_id = $this->assessment->id;
            $group->name = $_group['name'];
            $group->save();

            foreach ($_group['statements'] as $_statement) {
                $statement = null;
                if ($_statement['id']) {
                    $statement = AssessmentStatement::find($_statement['id']);
                }

                if (! $statement) {
                    $statement = new AssessmentStatement();
                }

                $statement->assessment_id = $this->assessment->id;
                $statement->assessment_group_id = $group->id;
                $statement->statement = $_statement['statement'];
                $statement->scale = (float) $_statement['scale'];
                $statement->scale_1_text = $_statement['scale_1_text'];
                $statement->scale_1_explanation = $_statement['scale_1_explanation'];
                $statement->scale_1 = (float) $_statement['scale_1'];
                $statement->scale_2_text = $_statement['scale_2_text'];
                $statement->scale_2_explanation = $_statement['scale_2_explanation'];
                $statement->scale_2 = (float) $_statement['scale_2'];
                $statement->scale_3_text = $_statement['scale_3_text'];
                $statement->scale_3_explanation = $_statement['scale_3_explanation'];
                $statement->scale_3 = (float) $_statement['scale_3'];
                $statement->scale_4_text = $_statement['scale_4_text'];
                $statement->scale_4_explanation = $_statement['scale_4_explanation'];
                $statement->scale_4 = (float) $_statement['scale_4'];
                $statement->scale_5_text = $_statement['scale_5_text'];
                $statement->scale_5_explanation = $_statement['scale_5_explanation'];
                $statement->scale_5 = (float) $_statement['scale_5'];
                $statement->scale_6_text = $_statement['scale_6_text'];
                $statement->scale_6_explanation = $_statement['scale_6_explanation'];
                $statement->scale_6 = (float) $_statement['scale_6'];
                $statement->scale_7_text = $_statement['scale_7_text'];
                $statement->scale_7_explanation = $_statement['scale_7_explanation'];
                $statement->scale_7 = (float) $_statement['scale_7'];
                $statement->scale_8_text = $_statement['scale_8_text'];
                $statement->scale_8_explanation = $_statement['scale_8_explanation'];
                $statement->scale_8 = (float) $_statement['scale_8'];
                $statement->scale_9_text = $_statement['scale_9_text'];
                $statement->scale_9_explanation = $_statement['scale_9_explanation'];
                $statement->scale_9 = (float) $_statement['scale_9'];
                $statement->scale_10_text = $_statement['scale_10_text'];
                $statement->scale_10_explanation = $_statement['scale_10_explanation'];
                $statement->scale_10 = (float) $_statement['scale_10'];
                $statement->save();
            }

            $existing_ids = [];

            foreach ($_group['markings'] as $_marking) {
                $marking = null;
                if ($_marking['id']) {
                    $marking = AssessmentGroupMarking::find($_marking['id']);
                }

                if (! $marking) {
                    $marking = new AssessmentGroupMarking();
                }

                $marking->assessment_id = $this->assessment->id;
                $marking->assessment_group_id = $group->id;
                $marking->score_from = (int) $_marking['score_from'];
                $marking->score_to = (int) $_marking['score_to'];
                $marking->name = $_marking['name'];
                $marking->pre_explanation = $_marking['pre_explanation'];
                $marking->post_explanation = $_marking['post_explanation'];
                $marking->save();

                $existing_ids[] = $marking->id;
            }

            $group->load('markings');
            $group->markings()->whereNotIn('id', $existing_ids)->delete();
        }

        return redirect()->route('dashboard.assessments.edit', [$this->assessment->id])->with(['success' => 'Assessment Updated.']);
    }

    public function render()
    {
        return view(
            'livewire.assessments.manage',
            []
        );
    }
}
