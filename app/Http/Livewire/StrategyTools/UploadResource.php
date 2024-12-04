<?php

namespace App\Http\Livewire\StrategyTools;

use App\Models\Resource;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadResource extends Component
{
    use WithFileUploads;

    public $file;
    public $article;

    public $rules = [
        'file' => ['required']
    ];

    public function mount($article)
    {
        if ($article) {
            $this->article = $article;
        }
    }

    public function updated($property_name)
    {
        if ($property_name == 'file') {
            $this->upload();
        }
    }

    public function upload()
    {
        $this->validate();

        if ($this->file) {
            $document = new Resource();
            $document->type = 'strategy';
            $document->user_id = auth()->user()->id;
            $document->filename = $this->file->getClientOriginalName();
            $document->extension = $this->file->getClientOriginalExtension();
            $document->size = $this->file->getSize();
            $document->mime = $this->file->getMimeType();
            $document->path = $this->file->store(
                'public/resources/',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
            $document->format = $document->mime;
            $document->save();

            if ($this->article) {
                $this->article->assignResource($document);
            }

            $this->emit('close-upload-resource-modal', true);

            if ($this->article) {
                return redirect()->route('dashboard.strategy-tools.articles.view', [$this->article->id, 'tab' => 'resources'])->with(['success' => 'Resource Added.']);
            }

            return redirect()->route('dashboard.strategy-tools.resources')->with(['success' => 'Resource Added']);
        }
    }

    public function render()
    {
        return view('livewire.strategy-tools.upload-resource');
    }
}
