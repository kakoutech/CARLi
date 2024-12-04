<?php

namespace App\Http\Livewire\StrategyTools;

use App\Models\StrategyToolArticle;
use App\Models\StrategyToolTopic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class ManageArticle extends Component
{
    use WithFileUploads;

    public $article;
    public $edit_article;

    public $icon_file;
    public $thumbnail_file;

    public $rules = [
        'edit_article.title' => ['required'],
        'edit_article.strategy_tool_topic_id' => ['required'],
        'edit_article.content' => [],
        'edit_article.icon_path' => [],
        'edit_article.thumbnail_path' => [],
        'edit_article.active' => ['required'],
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
        $this->validate();

        if ($this->icon_file) {
            $this->edit_article->icon_path = $this->icon_file->store(
                'public/media/articles/',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        if ($this->thumbnail_file) {
            $this->edit_article->thumbnail_path = $this->thumbnail_file->store(
                'public/media/articles/',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->edit_article->save();

        return redirect()->route('dashboard.strategy-tools.articles.view', [$this->edit_article->id])->with(['success' => 'Article Updated.']);
    }

    public function render()
    {
        $formats = getFormats();

        return view(
            'livewire.strategy-tools.manage-article',
            [
                'topics' => StrategyToolTopic::all(),
                'formats' => $formats
            ]
        );
    }
}
