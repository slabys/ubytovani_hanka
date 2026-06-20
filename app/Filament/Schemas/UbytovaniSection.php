<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class UbytovaniSection
{
    public static function make(): Section
    {
        return Section::make('Ubytování')
            ->schema([
                TextInput::make('ubytovani.anchor')
                    ->label('Kotva sekce')
                    ->prefix('#')
                    ->required()
                    ->placeholder('ubytovani'),
                TextInput::make('ubytovani.heading')
                    ->label('Nadpis')
                    ->required(),
                TextInput::make('ubytovani.subheading')
                    ->label('Podnadpis'),
                Repeater::make('ubytovani.items')
                    ->label('Možnosti ubytování')
                    ->schema([
                        TextInput::make('title')
                            ->label('Název')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->label('Popis')
                            ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                            ->columnSpanFull(),
                        TextInput::make('price')
                            ->label('Cena')
                            ->placeholder('od 1 500 Kč / noc'),
                        FileUpload::make('gallery')
                            ->label('Galerie fotografií')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('ubytovani')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->reorderableWithButtons()
                    ->addActionLabel('Přidat ubytování')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            'anchor' => 'ubytovani',
            'heading' => 'Ubytování',
            'subheading' => 'Vyberte si z našich možností',
            'items' => [
                [
                    'title' => 'Apartmán',
                    'description' => 'Prostorný apartmán s plně vybavenou kuchyní, obývacím pokojem a ložnicí. Ideální pro rodiny nebo páry hledající soukromí a pohodlí.',
                    'price' => 'od 1 500 Kč / noc',
                    'gallery' => [],
                ],
                [
                    'title' => 'Hotelový pokoj',
                    'description' => 'Útulný hotelový pokoj s výhledem do přírody. Snídaně v ceně, WiFi zdarma. Perfektní pro krátké pobyty nebo výlety k Lipnu.',
                    'price' => 'od 800 Kč / noc',
                    'gallery' => [],
                ],
            ],
        ];
    }
}
