<?php

namespace App\Filament\Pages;

use App\Filament\Forms\LocaleFields;
use App\Filament\Forms\MediaUpload;
use App\Models\WhyUsSetting;
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

class ManageWhyUsSettings extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';

    protected static ?string $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Why Us Section';

    protected static ?string $title = 'Why Us Section';

    protected static string $view = 'filament.pages.manage-why-us-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $record = WhyUsSetting::query()->firstOrFail();
        $this->form->fill($record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make('Video')
                            ->description('Background video for the Why Us section on the homepage.')
                            ->schema([
                                MediaUpload::video('video_path', 'Video')
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(['lg' => 1]),

                        Section::make('Poster')
                            ->description('Thumbnail shown before the video plays.')
                            ->schema([
                                MediaUpload::image('poster_path', 'Poster image', 'assets/uploads/why-us')
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ])
                    ->columns(['lg' => 2]),

                LocaleFields::tabs(fn (string $locale) => [
                    LocaleFields::text('title', 'Section title', $locale),
                    LocaleFields::tags('bullets', 'Bullet points', $locale)
                        ->helperText('Press Enter after each point.'),
                ], 'Section content'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $record = WhyUsSetting::query()->firstOrFail();
        $record->update($this->form->getState());

        app(FrontendContentService::class)->clearCache();

        Notification::make()
            ->title('Why us settings saved')
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
