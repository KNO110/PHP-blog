<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PostPublished extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $text
    ) {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Post Published',
        );
    }

    public function content(): Content
    {
        return new Content(
            //html: 'mail.posts.published',
            markdown: 'mail.posts.published-markdown',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(Storage::disk('public')->path('1.pdf'))
        ];
    }
}
