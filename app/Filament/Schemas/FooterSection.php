<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class FooterSection
{
    public static function make(): Section
    {
        return Section::make('Patička')
            ->schema([
                TextInput::make('footer.copyright')
                    ->label('Copyright text')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('footer.facebook')
                    ->label('Facebook URL')
                    ->url()
                    ->placeholder('https://facebook.com/...'),
                TextInput::make('footer.instagram')
                    ->label('Instagram URL')
                    ->url()
                    ->placeholder('https://instagram.com/...'),
                TextInput::make('footer.whatsapp')
                    ->label('WhatsApp číslo')
                    ->placeholder('+420123456789')
                    ->helperText('Mezinárodní formát bez mezer, např. +420123456789'),
            ])
            ->columns(2);
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            'copyright' => '© '.date('Y').' Ubytování Hanka. Všechna práva vyhrazena.',
            'facebook' => '',
            'instagram' => '',
            'whatsapp' => '',
        ];
    }
}
