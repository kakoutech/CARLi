<?php

namespace App\Http\Livewire\Admin\ToolsAndResourcesTopics;

use App\Models\ToolResourceTopic;
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
            $this->topic = new ToolResourceTopic();
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

        return redirect()->route('admin.tools-and-resources-topics.edit', [$this->edit_topic->id])->with(['success' => 'Topic Updated.']);
    }

    public function render()
    {
        return view('livewire.admin.tools-and-resources-topics.manage');
    }
}
