<?php

namespace App\Http\Livewire\Badges;

use App\Models\BadgeLevel;
use App\Models\Badge;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageLevel extends Component
{
    use WithFileUploads;

    public $image_file;
    public $badge;
    public $badge_level;

    public $rules = [
        'image_file' => [],
        'badge_level.badge_id' => ['required'],
        'badge_level.name' => ['required'],
        'badge_level.condition' => ['required'],
        'badge_level.image_path' => [],
        'badge_level.active' => ['required'],
    ];

    public function mount($badge, $badge_level)
    {
        $this->badge = $badge;
        $this->badge_level = $badge_level;

        if (!$this->badge_level) {
            $this->badge_level = new BadgeLevel();
            $this->badge_level->badge_id = $badge->id;
        }
    }

    public function save()
    {
        abort_unless(user()->canView('badges.level'), 403);

        $this->validate();

        if (!$this->badge_level->badge_id) {
            $this->badge_level->badge_id = $this->badge->id;
        }

        if ($this->image_file) {
            $this->badge_level->image_path = $this->image_file->store(
                'public/media/badges',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
        }

        $this->badge_level->save();

        return redirect()->route('dashboard.gamification.badges.levels.edit', [$this->badge->id, $this->badge_level->id])->with(['success' => 'Badge Level Updated.']);
    }

    public function render()
    {
        return view(
            'livewire.badges.manage-level',
            [
                'badge_types' => Badge::all()
            ]
        );
    }
}
