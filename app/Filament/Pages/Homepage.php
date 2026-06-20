<?php

namespace App\Filament\Pages;

use App\Models\PageContent;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Pages\PageConfiguration;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @extends Page<PageConfiguration>
 */
class Homepage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->content->fill([
            'nav_items' => PageContent::get('nav_items', [
                ['label' => 'Domů', 'anchor' => 'home'],
                ['label' => 'Ubytování', 'anchor' => 'ubytovani'],
                ['label' => 'Galerie', 'anchor' => 'galerie'],
                ['label' => 'Kontakt', 'anchor' => 'kontakt'],
            ]),
            'hero' => PageContent::get('hero', [
                'anchor' => 'home',
                'heading' => 'Ubytování Hanka',
                'subheading' => 'Frymburk u Lipna',
                'description' => 'Klidné ubytování v srdci jižních Čech, u krásné přírody Lipna.',
                'cta_label' => 'Zobrazit ubytování',
                'cta_anchor' => 'ubytovani',
                'image' => null,
            ]),
            'ubytovani' => PageContent::get('ubytovani', [
                'anchor' => 'ubytovani',
                'heading' => 'Ubytování',
                'subheading' => 'Vyberte si z našich možností',
                'items' => [
                    [
                        'title' => 'Apartmán',
                        'description' => 'Prostorný apartmán s plně vybavenou kuchyní, obývacím pokojem a ložnicí. Ideální pro rodiny nebo páry hledající soukromí a pohodlí.',
                        'price' => 'od 1 500 Kč / noc',
                        'image' => null,
                    ],
                    [
                        'title' => 'Hotelový pokoj',
                        'description' => 'Útulný hotelový pokoj s výhledem do přírody. Snídaně v ceně, WiFi zdarma. Perfektní pro krátké pobyty nebo výlety k Lipnu.',
                        'price' => 'od 800 Kč / noc',
                        'image' => null,
                    ],
                ],
            ]),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [Action::make('save')->label('Uložit')->action('save')];
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Navigace')
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
                    ]),

                Section::make('Hero sekce')
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
                    ->columns(2),

                Section::make('Ubytování')
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
                                FileUpload::make('image')
                                    ->label('Fotografie')
                                    ->image()
                                    ->disk('public')
                                    ->directory('ubytovani'),
                            ])
                            ->columns(2)
                            ->reorderableWithButtons()
                            ->addActionLabel('Přidat ubytování')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->content->getState();

        PageContent::set('nav_items', $data['nav_items']);
        PageContent::set('hero', $data['hero']);
        PageContent::set('ubytovani', $data['ubytovani']);

        Notification::make()->title('Uloženo')->success()->send();
    }
}
