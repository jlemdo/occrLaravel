<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskReminderNotification extends Notification
{
	 private $task;
    /**
     * Create a new notification instance.
     */
  public function __construct($task)
    {
        $this->task = $task;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
   public function via($notifiable)
    {
        return ['database', 'mail']; // Use mail and/or database notifications
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Task Reminder: ' . $this->task->title)
            ->line('Your task "' . $this->task->title . '" is due soon.')
            ->line('Deadline: ' . $this->task->date . ' ' . $this->task->time)
            ->line('Please make sure to complete it on time.');
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
		$url = 'leaddetails/' . $this->task->leadid;
return [
'title' => 'Task is due with in 24 Hors',
'message' => 'Your task is due in less than 24 hours, '.$this->task->title.'. deadline'.$this->task->date .' '. $this->task->time,
'url' => $url,
];
    }
}
