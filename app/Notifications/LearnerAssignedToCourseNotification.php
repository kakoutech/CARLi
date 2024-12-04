<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LearnerAssignedToCourseNotification extends Notification
{
    use Queueable;
    public $course_enroll;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($course_enroll)
    {
        $this->course_enroll = $course_enroll;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function display()
    {
        return 'display';
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'course_enroll_id' => $this->course_enroll->id
        ];
    }
}
