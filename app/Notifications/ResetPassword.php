<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $name = $notifiable->name;

        return (new MailMessage)
                    ->subject('パスワード変更')
                    ->greeting('こんにちは、'. $name .'さん')
                    ->line('60分以内に以下のリンクからパスワード変更を行ってください。')
                    ->action('パスワードをリセットする',url(route('password.reset', ['token' => $this->token,'email' => $notifiable->getEmailForPasswordReset(),], false)))
                    ->line('本メールに心当たりが無い場合は破棄をお願いいたします。 送信専用メールアドレスのため、直接の返信はできません。');

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
