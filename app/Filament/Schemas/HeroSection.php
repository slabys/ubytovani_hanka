<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class HeroSection
{
    public static function make(): Section
    {
        return Section::make('Hero sekce')
            ->schema([
                TextInput::make('hero.anchor')
                    ->label('Kotva sekce')
                    ->prefix('#')
                    ->required()
                    ->placeholder('home'),
                FileUpload::make('hero.image')
                    ->label('Obrázek na pozadí')
                    ->image()
                    ->disk('public')
                    ->directory('hero')
                    ->columnSpanFull(),
                TextInput::make('hero.heading')
                    ->label('Nadpis')
                    ->required(),
                TextInput::make('hero.subheading')
                    ->label('Podnadpis'),
                Textarea::make('hero.description')
                    ->label('Popis')
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('hero.cta_label')
                    ->label('Text tlačítka'),
                TextInput::make('hero.cta_anchor')
                    ->label('Kotva tlačítka')
                    ->prefix('#')
                    ->placeholder('ubytovani'),
            ])
            ->columns(2);
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            'anchor' => 'home',
            'heading' => 'Ubytování Hanka',
            'subheading' => 'Frymburk u Lipna',
            'description' => 'Klidné ubytování v srdci jižních Čech, u krásné přírody Lipna.',
            'cta_label' => 'Zobrazit ubytování',
            'cta_anchor' => 'ubytovani',
            'image' => null,
        ];
    }
}
