<?php

namespace App\Filament\Pages;

use App\Filament\Schemas\EmailSection;
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
class Emails extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'E-mailové šablony';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->content->fill([
            'emails' => PageContent::get('emails', EmailSection::defaults()),
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
                ...EmailSection::make(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->content->getState();

        PageContent::set('emails', $data['emails']);

        Notification::make()->title('Uloženo')->success()->send();
    }
}
