<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class SluzbySection
{
    public static function make(): Section
    {
        return Section::make('Služby a okolí')
            ->schema([
                TextInput::make('sluzby.anchor')
                    ->label('Kotva sekce')
                    ->prefix('#')
                    ->required()
                    ->placeholder('sluzby'),
                TextInput::make('sluzby.heading')
                    ->label('Nadpis')
                    ->required(),
                TextInput::make('sluzby.subheading')
                    ->label('Podnadpis'),
                Repeater::make('sluzby.items')
                    ->label('Položky')
                    ->schema([
                        TextInput::make('icon')
                            ->label('Ikona (emoji)')
                            ->placeholder('🚴'),
                        TextInput::make('title')
                            ->label('Název')
                            ->required(),
                        RichEditor::make('description')
                            ->label('Popis')
                            ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->reorderableWithButtons()
                    ->addActionLabel('Přidat položku')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            'anchor' => 'sluzby',
            'heading' => 'Služby a okolí',
            'subheading' => 'Co u nás a v okolí najdete',
            'items' => [
                ['icon' => '🏖️', 'title' => 'Pláž Lipno', 'description' => '<p>Písečná pláž u přehrady Lipno vzdálená jen pár minut chůze.</p>'],
                ['icon' => '🚴', 'title' => 'Cyklotrasy', 'description' => '<p>Rozsáhlá síť cyklostezek kolem celého Lipna.</p>'],
                ['icon' => '⛵', 'title' => 'Půjčovna lodí', 'description' => '<p>Možnost půjčení loděk, šlapadel a paddleboardů přímo u jezera.</p>'],
                ['icon' => '🎿', 'title' => 'Ski Lipno', 'description' => '<p>Lyžařský areál Lipno – největší ski resort jižních Čech.</p>'],
            ],
        ];
    }
}
