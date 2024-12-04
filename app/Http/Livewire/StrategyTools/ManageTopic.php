<?php

namespace App\Http\Livewire\StrategyTools;

use App\Models\StrategyToolTopic;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageTopic extends Component
{
    use WithFileUploads;

    public $icon_file;
    public $thumbnail_file;

    public $topic;
    public $edit_topic;

    public $rules = [
        'edit_topic.name' => ['required'],
        'edit_topic.description' => ['required'],
        'edit_topic.order' => ['required'],
        'edit_topic.parent_id' => [],
        'edit_topic.icon_path' => [],
        'edit_topic.thumbnail_path' => [],
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

        if ($this->icon_file) {
            $this->edit_topic->icon_path = $this->icon_file->store(
                'public/media/strategy-topics',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        if ($this->thumbnail_file) {
            $this->edit_topic->thumbnail_path = $this->thumbnail_file->store(
                'public/media/strategy-topics',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->edit_topic->save();

        return redirect()->route('dashboard.strategy-tools.topics.edit', [$this->edit_topic->id])->with(['success' => 'Topic Updated.']);
    }

    public function getParents()
    {
        if ($this->edit_topic && isset($this->edit_topic->id)) {
            return StrategyToolTopic::where('id', '!=', $this->edit_topic->id)->select('id', 'name')->get();
        }

        return StrategyToolTopic::select('id', 'name')->get();
    }

    public function render()
    {
        return view(
            'livewire.strategy-tools.manage-topic',
            [
                'parents' => $this->getParents()
            ]
        );
    }
}
