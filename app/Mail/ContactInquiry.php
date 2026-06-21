<?php

namespace App\Mail;

use App\Filament\Schemas\EmailSection;
use App\Models\PageContent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public string $htmlBody;

    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $body,
    ) {
        $template = PageContent::get('emails', EmailSection::defaults());
        $raw = $template['inquiry']['body'] ?? '';

        $this->htmlBody = str_replace(
            ['{name}', '{email}', '{phone}', '{message}'],
            [e($name), e($email), e($phone), nl2br(e($body))],
            $raw
        );
    }

    public function envelope(): Envelope
    {
        $template = PageContent::get('emails', EmailSection::defaults());
        $subject = $template['inquiry']['subject'] ?? '[Ubytování Hanka] - rezervace';

        return new Envelope(
            subject: $subject,
            replyTo: [$this->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.contact-inquiry',
        );
    }
}
