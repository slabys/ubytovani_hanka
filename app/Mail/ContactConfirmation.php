<?php

namespace App\Mail;

use App\Filament\Schemas\EmailSection;
use App\Models\PageContent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public string $htmlBody;

    public function __construct(
        public string $name,
        public string $body,
    ) {
        $template = PageContent::get('emails', EmailSection::defaults());
        $raw = $template['confirmation']['body'] ?? '';

        $this->htmlBody = str_replace(
            ['{name}', '{message}'],
            [e($name), nl2br(e($body))],
            $raw
        );
    }

    public function envelope(): Envelope
    {
        $template = PageContent::get('emails', EmailSection::defaults());
        $subject = $template['confirmation']['subject'] ?? '[Ubytování Hanka] - odesláno';

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.contact-confirmation',
        );
    }
}
