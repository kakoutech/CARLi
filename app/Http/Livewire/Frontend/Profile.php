<?php

namespace App\Http\Livewire\Frontend;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $avatar_file;
    public $avatar;
    public $avatar_path;
    public $password;

    public $rules = [
        'password' => [],
        'user.first_name' => ['required', 'string', 'max:255'],
        'user.last_name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'email'],
        'user.telephone_number' => ['required', 'max:255'],
        'user.company_name' => ['nullable', 'required', 'string', 'max:255'],
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->avatar = $this->user->getAvatar();
        $this->avatar_path = $this->user->avatar_path;
    }

    public function updated($property_name)
    {
        if ($property_name == 'avatar_file') {
            auth()->user()->avatar_path = $this->avatar_file->store(
                'public/assets/avatars',
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
            auth()->user()->save();
            $this->avatar = asset(str_replace('public', 'storage', auth()->user()->avatar_path));
        }
    }

    public function save()
    {
        $this->validate();

        $this->validate([
            'user.email' => ['required', Rule::unique('users', 'email')->ignore($this->user->id)]
        ]);

        if ($this->password) {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->avatar_path = $this->avatar_path;

        $this->user->save();

        return redirect()->route('profile')->with(['success' => 'Profile Updated.']);
    }
    
    public function render()
    {
        return view('livewire.frontend.profile');
    }
}
