<?php

namespace App\Http\Livewire\Users\Learner;

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
        'edit_user.trainer_id' => ['required'],
    ];

    public function mount($user)
    {
        $this->user = $user;

        if (!$this->user) {
            $this->user = new User();
            $this->password = Str::random(8);
        }

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
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->validate();

        if ($this->edit_user->id) {
            $this->validate([
                'edit_user.email' => ['required', Rule::unique('users', 'email')->ignore($this->edit_user->id)]
            ]);
        } else {
            $this->validate([
                'edit_user.email' => ['required', 'unique:users,email']
            ]);
        }

        if ($this->password) {
            $this->edit_user->password = Hash::make($this->password);
        }

        $this->edit_user->avatar_path = $this->avatar_path;

        $this->edit_user->account_type = 'learner';

        $trainer = User::find($this->edit_user->trainer_id);
        $this->edit_user->employer_id = $trainer->employer_id;

        $method = $this->edit_user->id ? 'updated' : 'created';

        $this->edit_user->save();

        if ($method == 'updated') {
            $this->edit_user->notify(new AccountUpdatedNotification($this->edit_user));
        } else {
            $this->edit_user->notify(new AccountCreatedNotification($this->edit_user));
        }

        if (auth()->user()->id == $this->edit_user->id) {
            return redirect()->route('dashboard.profile')->with(['success' => 'Profile Updated.']);
        }

        return redirect()->route('dashboard.learners.edit', [$this->edit_user->id])->with(['success' => 'Learner Updated.']);
    }

    public function render()
    {
        return view('livewire.users.learner.manage');
    }
}
