<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LeaveReviewed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($leave)
    {
        $this->leave = $leave;
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
        $employeeName = $this->leave->employees->first_name.' '.$this->leave->employees->last_name;
        $projectManager = $this->leave->employees->supervisors->info->first_name;
        $url = url('/leaves/'.$this->leave->id.'/review');
        return (new MailMessage)
                    ->subject('Review '.$employeeName.'\'s filed leave')
                    ->greeting('Hi '.$projectManager.'!')
                    ->line($employeeName. ' has filed for a leave.')
                    ->line('You may review the leave here:')
                    ->action('Review '.$employeeName.'\'s Leave', $url)
                    ->line('Thank you for using TEAMS!');
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
