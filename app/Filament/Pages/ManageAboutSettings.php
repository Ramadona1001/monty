<?php

namespace App\Filament\Pages;

use App\Filament\Forms\LocaleFields;
use App\Filament\Forms\MediaUpload;
use App\Models\AboutSetting;
use App\Services\FrontendContentService;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Concerns\InteractsWithFormActions;

class ManageAboutSettings extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'About Page';

    protected static ?string $title = 'About & Homepage Sections';

    protected static string $view = 'filament.pages.manage-about-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $record = AboutSetting::query()->firstOrFail();
        $this->form->fill($record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('About page intro')
                    ->description('Content shown at the top of the About page.')
                    ->schema([
                        Grid::make()
                            ->schema([
                                MediaUpload::image('intro_image', 'Intro image', 'assets/uploads/about')
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(['lg' => 1]),
                        LocaleFields::tabs(fn (string $locale) => [
                            LocaleFields::text('intro_title', 'Intro title', $locale),
                            LocaleFields::text('intro_subtitle', 'Intro subtitle', $locale),
                            LocaleFields::textarea('intro_body', 'Intro body', $locale, 6),
                        ], 'Intro text')
                            ->columnSpan(['lg' => 2]),
                    ])
                    ->columns(['lg' => 3]),

                Section::make('Vision & mission')
                    ->schema([
                        LocaleFields::tabs(fn (string $locale) => [
                            LocaleFields::text('vision_title', 'Vision title', $locale),
                            LocaleFields::textarea('vision_body', 'Vision body', $locale, 4),
                            LocaleFields::text('mission_title', 'Mission title', $locale),
                            LocaleFields::textarea('mission_body', 'Mission body', $locale, 4),
                        ], 'Vision & mission text'),
                    ]),

                Section::make('Homepage about section')
                    ->schema([
                        LocaleFields::tabs(fn (string $locale) => [
                            LocaleFields::text('home_subheading', 'Subheading', $locale),
                            LocaleFields::text('home_heading', 'Heading', $locale),
                            LocaleFields::textarea('home_body', 'Body', $locale, 4),
                        ], 'About section text'),
                    ]),

                Section::make('Homepage services section')
                    ->schema([
                        LocaleFields::tabs(fn (string $locale) => [
                            LocaleFields::text('services_subheading', 'Subheading', $locale),
                            LocaleFields::text('services_heading', 'Heading', $locale),
                            LocaleFields::textarea('services_intro', 'Intro', $locale, 3),
                        ], 'Services section text'),
                    ]),

                Section::make('Homepage work process section')
                    ->schema([
                        LocaleFields::tabs(fn (string $locale) => [
                            LocaleFields::text('progress_subheading', 'Subheading', $locale),
                            LocaleFields::text('progress_heading', 'Heading', $locale),
                        ], 'Work process headings'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $record = AboutSetting::query()->firstOrFail();
        $record->update($this->form->getState());

        app(FrontendContentService::class)->clearCache();

        Notification::make()
            ->title('About settings saved')
            ->success()
            ->send();
    }

    /** @return list<Action> */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save changes')
                ->submit('save'),
        ];
    }
}
