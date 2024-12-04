<?php

namespace App\Http\Livewire\Admin\StrategyToolsArticles;

use App\Models\StrategyToolArticle;
use App\Models\StrategyToolTopic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Manage extends Component
{
    use WithFileUploads;

    public $article;
    public $edit_article;
    public $file;
    public $cover;

    public $rules = [
        'file' => [],
        'cover' => [],
        'edit_article.title' => ['required'],
        'edit_article.subtitle' => [],
        'edit_article.format' => ['required'],
        'edit_article.active' => ['required'],
        'edit_article.strategy_tool_topic_id' => ['required'],
        'edit_article.content' => [],
    ];

    public function mount($article)
    {
        $this->article = $article;

        if (!$this->article) {
            $this->article = new StrategyToolArticle();
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
            $this->edit_article->uploads = $this->file->store(
                'public/media/strategy-tools',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        if ($this->cover) {
            $this->edit_article->cover = $this->cover->store(
                'public/media/strategy-tools',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->edit_article->save();

        if (auth()->user()->isTrainer()) {
            return redirect()->route('strategy-tools')->with(['success' => 'Article Updated.']);
        }

        return redirect()->route('admin.strategy-tools.edit', [$this->edit_article->id])->with(['success' => 'Article Updated.']);
    }

    public function render()
    {
        $formats = getFormats();

        return view(
            'livewire.admin.strategy-tools-articles.manage',
            [
                'topics' => StrategyToolTopic::all(),
                'formats' => $formats
            ]
        );
    }
}
