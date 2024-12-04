<?php

namespace App\Http\Livewire\StrategyTools;

use App\Models\Resource;
use App\Models\StrategyToolArticle;
use Livewire\Component;

class AssignResource extends Component
{
    public $parent;
    public $article_id;
    public $resource_id;

    public $rules = [
        'resource_id' => ['required'],
        'article_id' => ['required']
    ];

    public function mount($parent, $article = null)
    {
        $this->parent = $parent;

        if ($article) {
            $this->article_id = $article->id;
        }
    }

    public function assign()
    {
        $this->validate();

        $resource = Resource::find($this->resource_id);
        if (!$resource) {
            $this->addError('resource_id', 'You must select a valid resource.');
            return;
        }

        $article = StrategyToolArticle::find($this->article_id);
        if (!$article) {
            $this->addError('article_id', 'You must select a valid article.');
            return;
        }

        $article->assignResource($resource);

        return redirect($this->parent)->with(['success' => 'Resource Assigned.']);
    }

    public function render()
    {
        return view(
            'livewire.strategy-tools.assign-resource',
            [
                'resources' => Resource::query()->get(),
                'articles' => StrategyToolArticle::query()->get(),
            ]
        );
    }
}
