<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LeaveProcessed extends Notification
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
        $employeeName = $this->leave->employees->first_name;
        $projectManager = $this->leave->employees->supervisors->info->first_name.' '.$this->leave->employees->supervisors->info->last_name;
        $result = strtolower($this->leave->status);
        if($result == "approved"){
            $successLine = "Congratulations! We're glad to inform you that  ";
        }else{
            $successLine = "We're sorry to inform you that ";
        }

        $url = url('/leaves/'.$this->leave->id);
        return (new MailMessage)
                    ->subject('Leave Approval')
                    ->greeting('Hi '.$employeeName.'!')
                    ->line($successLine.'your supervisor, '.$projectManager. ', has '.$result.' your leave.')
                    ->line('You may review your leave below')
                    ->action('View Leave', $url)
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
