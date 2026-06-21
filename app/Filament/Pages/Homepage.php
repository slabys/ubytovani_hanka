<?php

namespace App\Filament\Pages;

use App\Filament\Schemas\HeroSection;
use App\Filament\Schemas\KontaktSection;
use App\Filament\Schemas\NavSection;
use App\Filament\Schemas\UbytovaniSection;
use App\Models\PageContent;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Pages\PageConfiguration;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @extends Page<PageConfiguration>
 */
class Homepage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?int $navigationSort = 1;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->content->fill([
            'nav_items' => PageContent::get('nav_items', NavSection::defaults()),
            'hero' => PageContent::get('hero', HeroSection::defaults()),
            'ubytovani' => PageContent::get('ubytovani', UbytovaniSection::defaults()),
            'kontakt' => PageContent::get('kontakt', KontaktSection::defaults()),
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
                NavSection::make(),
                HeroSection::make(),
                UbytovaniSection::make(),
                KontaktSection::make(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->content->getState();

        PageContent::set('nav_items', $data['nav_items']);
        PageContent::set('hero', $data['hero']);
        PageContent::set('ubytovani', $data['ubytovani']);
        PageContent::set('kontakt', $data['kontakt']);

        Notification::make()->title('Uloženo')->success()->send();
    }
}
