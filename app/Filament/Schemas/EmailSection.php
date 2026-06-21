<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class EmailSection
{
    /** @return array<int, Section> */
    public static function make(): array
    {
        return [
            Section::make('Příchozí rezervace (pro vás)')
                ->description('Dostupné proměnné: {name}, {email}, {phone}, {message}')
                ->schema([
                    TextInput::make('emails.inquiry.subject')
                        ->label('Předmět')
                        ->required()
                        ->columnSpanFull(),
                    RichEditor::make('emails.inquiry.body')
                        ->label('Obsah')
                        ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                        ->columnSpanFull(),
                ]),
            Section::make('Potvrzení zákazníkovi')
                ->description('Dostupné proměnné: {name}, {message}')
                ->schema([
                    TextInput::make('emails.confirmation.subject')
                        ->label('Předmět')
                        ->required()
                        ->columnSpanFull(),
                    RichEditor::make('emails.confirmation.body')
                        ->label('Obsah')
                        ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                        ->columnSpanFull(),
                ]),
        ];
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            'inquiry' => [
                'subject' => '[Ubytování Hanka] - rezervace',
                'body' => '<p>Nová zpráva od <strong>{name}</strong>.</p><p><strong>E-mail:</strong> {email}<br><strong>Telefon:</strong> {phone}</p><p><strong>Zpráva:</strong><br>{message}</p>',
            ],
            'confirmation' => [
                'subject' => '[Ubytování Hanka] - odesláno',
                'body' => '<p>Dobrý den, <strong>{name}</strong>,</p><p>děkujeme za vaši zprávu. Brzy se vám ozveme.</p><p><strong>Vaše zpráva:</strong><br>{message}</p><p>S pozdravem,<br>Ubytování Hanka</p>',
            ],
        ];
    }
}
