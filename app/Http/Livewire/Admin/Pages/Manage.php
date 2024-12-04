<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Str;

class Manage extends Component
{
    public $page;
    public $edit_page;
    public $path;

    public $rules = [
        'edit_page.name' => ['required'],
        'edit_page.subtitle' => ['required'],
        'edit_page.active' => ['required'],
        'edit_page.path' => ['required'],
        'edit_page.content' => ['required'],
    ];

    public function mount($page)
    {
        $this->page = $page;

        if (!$this->page) {
            $this->page = new Page();
        }

        $this->edit_page = $this->page;
        $this->edit_page->path = '/' . $this->edit_page->path;

        $this->path = $this->edit_page->path;
    }

    public function updated($property_name)
    {
        if ($property_name == 'edit_page.name') {
            if ($this->path == '/') {
                $this->edit_page->path = '/' . Str::slug($this->edit_page->name);
            }
        }
    }

    public function save()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->validate();

        if (substr($this->edit_page->path, 0, 1) == '/') {
            $this->edit_page->path = substr($this->edit_page->path, 1);
        }

        $this->edit_page->save();

        return redirect()->route('admin.pages.edit', [$this->edit_page->id])->with(['success' => 'Page Updated.']);
    }
    
    public function render()
    {
        return view('livewire.admin.pages.manage');
    }
}
