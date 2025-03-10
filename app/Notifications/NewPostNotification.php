<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class NewPostNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Post $post,
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //return ['mail', 'database'];
        return ['telegram'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject("Новий епізод: {$this->post->title}")
            ->greeting("Привіт, {$notifiable->name}!")
            ->line("Вийшов новий епізод: '{$this->post->title}'.")
            ->action('Переглянути', url("/posts/{$this->post->id}"))
            ->line('Приємного перегляду!');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'title' => $this->post->title,
            'message' => "Вийшов новий епізод: '{$this->post->title}'!",
            'url' => url("/posts/{$this->post->id}"),
        ];
    }

    public function toTelegram($notifiable)
    {
        $url = url('/posts/'.$this->post->slug);

        return TelegramMessage::create()
            // Optional recipient user id.
            ->to($notifiable->name)
            // Markdown supported.
            ->content("Hello there!")
            ->line("Your invoice has been *PAID* *".$this->post->title."*")
            ->line("Thank you!")

            // (Optional) Inline Buttons
            ->button('View Invoice', $url)
            ->button('Download Invoice', $url);
    }
}
