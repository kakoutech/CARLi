<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ReflectionJournalSubmission extends Notification
{
    use Queueable;

    public $user;
    public $entries;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $entries)
    {
        $this->user = $user;
        $this->entries = $entries;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage);

        $message->subject('Reflective Journal Submission: ' . $this->user->getFullName());

        foreach ($this->entries as $entry) {

            if ($entry->response) {
                $message->line(new HtmlString('<div><div><b>' . $entry->step->getTitle() . '</b></div><blockquote>' . $entry->response . '</blockquote></div>'));
            } else {
                $message->line(new HtmlString('<div><div><b>' . $entry->step->getTitle() . '</b></div><blockquote>No Response</blockquote></div>'));
            }
            
            if ($entry->audio) {
                $message->action('View Audio', $entry->getAudioUrl());
            }

            if ($entry->file) {
                $message->action('View Uploaded File', $entry->getFileUrl());
            }

        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
