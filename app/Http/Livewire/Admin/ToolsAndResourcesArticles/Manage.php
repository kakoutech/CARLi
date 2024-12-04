<?php

namespace App\Http\Livewire\Admin\ToolsAndResourcesArticles;

use App\Models\ToolResourceArticle;
use App\Models\ToolResourceTopic;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;

    public $file;
    public $cover;
    public $article;
    public $edit_article;

    public $rules = [
        'file' => [],
        'cover' => [],
        'edit_article.title' => ['required'],
        'edit_article.subtitle' => [],
        'edit_article.format' => ['required'],
        'edit_article.active' => ['required'],
        'edit_article.tool_resource_topic_id' => ['required'],
        'edit_article.content' => [],
    ];

    public function mount($article)
    {
        $this->article = $article;

        if (!$this->article) {
            $this->article = new ToolResourceArticle();
        }

        $this->edit_article = $this->article;
    }

    public function save()
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isTrainer()) {
            abort(403);
        }

        $this->validate();

        if ($this->file) {
            $this->edit_article->uploads = $this->file->store('public/media/tools-resources');
        }

        if ($this->cover) {
            $this->edit_article->cover = $this->cover->store('public/media/tools-and-resources');
        }

        $this->edit_article->save();

        if (auth()->user()->isTrainer()) {
            return redirect()->route('tools-and-resources')->with(['success' => 'Article Updated.']);
        }

        return redirect()->route('admin.tools-and-resources.edit', [$this->edit_article->id])->with(['success' => 'Article Updated.']);
    }

    public function render()
    {
        $formats = getFormats();

        return view(
            'livewire.admin.tools-and-resources-articles.manage',
            [
                'topics' => ToolResourceTopic::all(),
                'formats' => $formats
            ]
        );
    }
}
