<?php

namespace App\Http\Livewire\Admin\StrategyToolsTopics;

use App\Models\StrategyToolTopic;
use Livewire\Component;
use Str;

class Manage extends Component
{
    public $topic;
    public $edit_topic;

    public $rules = [
        'edit_topic.name' => ['required'],
        'edit_topic.active' => ['required'],
    ];

    public function mount($topic)
    {
        $this->topic = $topic;

        if (!$this->topic) {
            $this->topic = new StrategyToolTopic();
        }

        $this->edit_topic = $this->topic;
    }

    public function save()
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isTrainer()) {
            abort(403);
        }

        $this->validate();

        $this->edit_topic->save();

        return redirect()->route('admin.strategy-tools-topics.edit', [$this->edit_topic->id])->with(['success' => 'Topic Updated.']);
    }

    public function render()
    {
        return view('livewire.admin.strategy-tools-topics.manage');
    }
}
