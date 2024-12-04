<?php

namespace App\Http\Livewire\Admin\Users;

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
        'edit_user.first_name' => ['required'],
        'edit_user.last_name' => ['required'],
        'edit_user.email' => ['required'],
        'edit_user.account_type' => ['required', 'in:learner,trainer,employer,admin'],
        'edit_user.work_place' => ['required', 'string', 'max:255'],
        'edit_user.reflection_activity_date' => ['required'],
        'edit_user.trainer_id' => [],
        'edit_user.manager_name' => ['required', 'string', 'max:255'],
        'edit_user.reflection_activity_postcode' => ['required', 'string', 'max:255'],
        'edit_user.company_name' => ['required', 'string', 'max:255'],
        'edit_user.service_type' => ['required', 'string', 'max:255'],
        'edit_user.reporting_preference' => ['required'],
        'edit_user.phone_number' => ['required', 'max:255'],
        'edit_user.course' => ['required', 'string', 'max:255'],
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
            $this->avatar_path = $this->avatar_file->store('public/assets/avatars');
            $this->avatar = asset(str_replace('public', 'storage', $this->avatar_path));
        }
    }

    public function save()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->validate(['password' => [],
            'edit_user.first_name' => ['required'],
            'edit_user.last_name' => ['required'],
            'edit_user.email' => ['required'],
            'edit_user.account_type' => ['required', 'in:learner,trainer,employer,admin'],
        ]);

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

        if ($this->edit_user->account_type == 'learner') {
            $this->validate([
                'edit_user.phone_number' => ['required', 'max:255'],
                'edit_user.work_place' => ['required', 'string', 'max:255'],
                'edit_user.reflection_activity_date' => ['required'],
                'edit_user.manager_name' => ['required', 'string', 'max:255'],
                'edit_user.reflection_activity_postcode' => ['required', 'string', 'max:255'],
            ]);
        } elseif ($this->edit_user->account_type == 'employer') {
            $this->validate([
                'edit_user.company_name' => ['required', 'string', 'max:255'],
                'edit_user.service_type' => ['required', 'string', 'max:255'],
                'edit_user.reporting_preference' => ['required'],
                'edit_user.phone_number' => ['required', 'max:255'],
            ]);
        } elseif ($this->edit_user->account_type == 'trainer') {
            $this->validate([
                'edit_user.course' => ['required', 'string', 'max:255'],
            ]);
        }

        $method = $this->edit_user->id ? 'updated' : 'created';
        
        $this->edit_user->save();

        if ($method == 'updated') {
            $this->edit_user->notify(new AccountUpdatedNotification($this->edit_user));
        } else {
            $this->edit_user->notify(new AccountCreatedNotification($this->edit_user));
        }

        if (auth()->user()->id == $this->edit_user->id) {
            return redirect()->route('admin.dashboard.profile')->with(['success' => 'Profile Updated.']);
        }
        
        return redirect()->route('admin.users.edit', [$this->edit_user->id])->with(['success' => 'User Updated.']);
    }

    public function render()
    {
        return view('livewire.admin.users.manage');
    }
}
