<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class NavSection
{
    public static function make(): Section
    {
        return Section::make('Navigace')
            ->description('Odkazy zobrazené v hlavním menu.')
            ->schema([
                Repeater::make('nav_items')
                    ->label('Položky menu')
                    ->schema([
                        TextInput::make('label')
                            ->label('Název')
                            ->required(),
                        TextInput::make('anchor')
                            ->label('Kotva')
                            ->prefix('#')
                            ->required()
                            ->placeholder('ubytovani'),
                    ])
                    ->columns(2)
                    ->reorderableWithButtons()
                    ->addActionLabel('Přidat položku'),
            ]);
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            ['label' => 'Domů', 'anchor' => 'home'],
            ['label' => 'Ubytování', 'anchor' => 'ubytovani'],
            ['label' => 'Galerie', 'anchor' => 'galerie'],
            ['label' => 'Kontakt', 'anchor' => 'kontakt'],
        ];
    }
}
