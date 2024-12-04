<?php

namespace App\Http\Livewire\MultipleChoiceQuestions;

use App\Models\CourseTopic;
use App\Models\MultipleChoiceQuestion;
use App\Models\MultipleChoiceQuestionAnswer;
use App\Models\MultipleChoiceQuestionSet;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageSet extends Component
{
    use WithFileUploads;

    public $set;
    public $questions;

    public $rules = [
        'set.name' => ['required'],
        'set.minimum_percentage' => ['required'],
        'set.time_type' => ['required'],
        'set.time_allowed' => ['required', 'numeric'],
        'set.show_answer_sheet' => [],
        'set.show_explanation' => [],
        'set.topic_id' => ['required', 'exists:course_topics,id'],
        'set.subtopic_id' => ['nullable', 'exists:course_topics,id'],
        'set.active' => ['required'],
        //'questions.*.question' => ['required'],
        //'questions.*.file' => ['file'],
        //'questions.*.explanation' => [],
        //'questions.*.marks' => [],
        //'questions.*.type' => [],
    ];

    public function mount($set)
    {
        $this->set = $set;
        if (!$this->set) {
            $this->set = new MultipleChoiceQuestionSet();
            $this->set->minimum_percentage = 10;
            $this->set->time_type = 'question';
            $this->set->time_allowed = 1;
            $this->set->show_answer_sheet = 1;
            $this->set->show_explanation = 1;

            $this->addQuestion();
        } else {
            $this->questions = [];
            foreach ($this->set->questions as $_question) {
                $question = $_question->toArray();
                $question['file'] = null;
                if ($question['image_path']) {
                    $question['image_url'] = asset(str_replace('public', 'storage', $question['image_path']));
                } else {
                    $question['image_url'] = null;
                }
                $question['answers'] = [];

                foreach ($_question->answers as $answer) {
                    $question['answers'][] = $answer->toArray();
                }

                $this->questions[] = $question;
            }
        }
    }

    public function toggle($option)
    {
        $this->set->{$option} = !$this->set->{$option};
    }

    public function getCourseTopics()
    {
        return CourseTopic::orderBy('name', 'ASC')->get();
    }

    public function getTimeTypes()
    {
        return ['question' => 'Per Question', 'set' => 'Per Set'];
    }

    public function removeAnswer($question, $answer)
    {
        unset($this->questions[$question]['answers'][$answer]);
    }

    public function addAnswer($index)
    {
        $answer = [
            'answer' => '',
            'is_correct' => 1
        ];

        $this->questions[$index]['answers'][] = $answer;
    }

    public function addQuestion()
    {
        $question = [
            "id" => null,
            "multiple_choice_question_set_id" => $this->set->id,
            "type" => null,
            "marks" => null,
            "image_path" => null,
            "image_url" => null,
            "file" => null,
            "question" => null,
            "explanation" => null,
            "answers" => [],
            "created_at" => now()->format('c'),
            "updated_at" => now()->format('c')
        ];

        $this->questions[] = $question;
    }

    public function removeQuestion($index)
    {
        unset($this->questions[$index]);
    }

    public function save()
    {
        $this->validate();

        $this->set->save();

        $question_ids = [];
        foreach ($this->questions as $question) {
            $mcq = null;
            if (isset($question['id']) && $question['id']) {
                $mcq = MultipleChoiceQuestion::find($question['id']);
            }

            if (!$mcq) {
                $mcq = new MultipleChoiceQuestion();
            }

            $mcq->multiple_choice_question_set_id = $this->set->id;
            if ($question['file']) {
                $mcq->image_path = $question['file']->store(
                    'public/media/mcqs',
                    [
                        'visibility' => 'public',
                        'directory_visibility' => 'public'
                    ]
                );
                $question['image_url'] = asset(str_replace('public', 'storage', $mcq->image_path));
            }

            $mcq->question = $question['question'];
            $mcq->type = $question['type'];
            $mcq->marks = $question['marks'];
            $mcq->explanation = $question['explanation'];
            $mcq->save();
            $question_ids[] = $mcq->id;

            if ($question['type'] == 'multiple') {
                $answer_ids = [];
                foreach ($question['answers'] as $answer) {
                    $mcq_answer = null;
                    if (isset($answer['id']) && $answer['id']) {
                        $mcq_answer = MultipleChoiceQuestionAnswer::find($answer['id']);
                    }

                    if (!$mcq_answer) {
                        $mcq_answer = new MultipleChoiceQuestionAnswer();
                    }

                    $mcq_answer->multiple_choice_question_id = $mcq->id;
                    $mcq_answer->answer = $answer['answer'];
                    $mcq_answer->is_correct = isset($answer['is_correct']) && $answer['is_correct'] ? true : false;
                    $mcq_answer->save();
                    $answer_ids[] = $mcq_answer->id;
                }

                $mcq->load('answers');
                $mcq->answers()->whereNotIn('id', $answer_ids)->delete();
            }
        }

        $this->set->questions()->whereNotIn('id', $question_ids)->delete();

        return redirect()->route('dashboard.courses.mcqs.edit', [$this->set->id])->with(['success' => 'MCQ Updated.']);
    }

    public function render()
    {
        return view(
            'livewire.multiple-choice-questions.manage-set',
            [
                'topics' => $this->getCourseTopics(),
                'time_types' => $this->getTimeTypes()
            ]
        );
    }
}
