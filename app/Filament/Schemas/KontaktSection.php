<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class KontaktSection
{
    public static function make(): Section
    {
        return Section::make('Kontakt sekce')
            ->schema([
                TextInput::make('kontakt.anchor')
                    ->label('Kotva sekce')
                    ->prefix('#')
                    ->required()
                    ->placeholder('kontakt'),
                TextInput::make('kontakt.heading')
                    ->label('Nadpis')
                    ->required(),
                TextInput::make('kontakt.subheading')
                    ->label('Podnadpis'),
                TextInput::make('kontakt.phone')
                    ->label('Telefon')
                    ->placeholder('+420 123 456 789'),
                TextInput::make('kontakt.email')
                    ->label('E-mail')
                    ->email()
                    ->placeholder('info@ubytovanihanka.cz'),
                TextInput::make('kontakt.address')
                    ->label('Adresa')
                    ->placeholder('Frymburk 123, 382 79 Frymburk')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            'anchor' => 'kontakt',
            'heading' => 'Kontakt',
            'subheading' => 'Rádi vám odpovíme na vaše dotazy',
            'phone' => '+420 123 456 789',
            'email' => 'info@ubytovanihanka.cz',
            'address' => 'Frymburk 123, 382 79 Frymburk',
        ];
    }
}
