<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadNotification extends Notification
{
    use Queueable;

    public function __construct(public Lead $lead) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Новая заявка: '.$this->lead->type->label())
            ->line('Имя: '.$this->lead->name)
            ->line('Телефон: '.$this->lead->phone)
            ->action('Открыть в админке', url('/admin/leads/'.$this->lead->id.'/edit'));
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'lead_id' => $this->lead->id,
            'type' => $this->lead->type->value,
            'name' => $this->lead->name,
            'phone' => $this->lead->phone,
        ];
    }
}
