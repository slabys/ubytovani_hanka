<?php

namespace App\Filament\Pages;

use App\Models\PageContent;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
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
class Settings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $title = 'Nastavení';

    protected static ?int $navigationSort = 10;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->content->fill([
            'settings' => PageContent::get('settings', static::defaults()),
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
                Section::make('Obecné')
                    ->schema([
                        TextInput::make('settings.site_name')
                            ->label('Název webu')
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('settings.logo')
                            ->label('Logo / favicon (SVG)')
                            ->helperText('Jeden soubor slouží jako logo v navigaci i jako favicon prohlížeče.')
                            ->acceptedFileTypes(['image/svg+xml'])
                            ->disk('public')
                            ->directory('site')
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->content->getState();

        PageContent::set('settings', $data['settings']);

        Notification::make()->title('Uloženo')->success()->send();
    }

    /** @return array<string, mixed> */
    public static function defaults(): array
    {
        return [
            'site_name' => config('app.name', 'Ubytování Hanka – Frymburk, Lipno'),
            'logo' => null,
        ];
    }
}
