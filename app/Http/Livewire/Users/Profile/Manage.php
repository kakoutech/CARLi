<?php

namespace App\Http\Livewire\Users\Profile;

use App\Models\User;
use App\Notifications\AccountCreatedNotification;
use App\Notifications\AccountUpdatedNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Manage extends Component
{
    use WithFileUploads;

    public $user;
    public $edit_user;
    public $avatar_file;
    public $avatar_path;
    public $avatar;
    public $password;

    public $rules = [
        'password' => [],
        'edit_user.about' => [],
        'edit_user.first_name' => ['required'],
        'edit_user.last_name' => ['required'],
        'edit_user.email' => ['required'],
        'edit_user.telephone_number' => [],
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->edit_user = $this->user;
        $this->avatar = $this->edit_user->getAvatar();
        $this->avatar_path = $this->edit_user->avatar_path;
    }

    public function updated($property_name)
    {
        if ($property_name == 'avatar_file') {
            $this->avatar_path = $this->avatar_file->store(
                'public/assets/avatars',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
            $this->avatar = asset(str_replace('public', 'storage', $this->avatar_path));
        }
    }

    public function save()
    {
        $this->validate();

        $this->validate([
            'edit_user.email' => ['required', Rule::unique('users', 'email')->ignore($this->edit_user->id)]
        ]);

        if ($this->password) {
            $this->edit_user->password = Hash::make($this->password);
        }

        $this->edit_user->avatar_path = $this->avatar_path;

        $this->edit_user->save();

        $this->edit_user->notify(new AccountUpdatedNotification($this->edit_user));

        return redirect()->route('dashboard.profile')->with(['success' => 'Profile Updated.']);
    }

    public function render()
    {
        return view('livewire.users.profile.manage');
    }
}
