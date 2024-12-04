<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;

class Dismiss extends Component
{
    public $notification_id;

    public function mount($notification_id)
    {
        $this->notification_id = $notification_id;
    }

    public function dismiss()
    {

        $notification = Notification::find($this->notification_id);
        if ($notification) {
            $notification->delete();
        }

        return redirect()->route('dashboard.notifications')->with(['success' => 'Notification Dismissed']);
    }

    public function render()
    {
        return view('livewire.notifications.dismiss');
    }
}
