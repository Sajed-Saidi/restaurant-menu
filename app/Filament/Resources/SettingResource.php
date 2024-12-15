<?php

namespace App\Filament\Resources;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LaravelQRCode\Facades\QRCode;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        // Section: General Information
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('website_name')
                                    ->label('Website Name')
                                    ->required()
                                    ->maxLength(191)
                                    ->placeholder('Enter website name'),

                                Forms\Components\TextInput::make('email')
                                    ->label('Email Address')
                                    ->email()
                                    ->required()
                                    ->maxLength(191)
                                    ->placeholder('Enter email address'),

                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->tel()
                                    ->maxLength(191)
                                    ->placeholder('Enter phone number'),

                                Forms\Components\TextInput::make('address')
                                    ->label('Address')
                                    ->maxLength(191)
                                    ->placeholder('Enter your address'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->maxLength(191)
                                    ->placeholder('Enter Facebook URL'),

                                Forms\Components\TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->maxLength(191)
                                    ->placeholder('Enter Instagram URL'),
                            ])
                            ->columns(2), // Two columns for better layout
                    ]),

                Group::make()
                    ->schema([
                        // Section: SEO Information
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->hiddenLabel()
                                    ->image()
                                    ->required()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/*'])
                                    ->validationMessages([
                                        'max' => 'Each image must not exceed 2MB in size.',
                                    ]),

                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->columnSpanFull()
                                    ->placeholder('Enter meta description for SEO'),

                                Forms\Components\TextInput::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->maxLength(191)
                                    ->placeholder('Enter meta keywords for SEO'),
                            ])
                            ->columns(1)
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('website_name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\ImageColumn::make('logo'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->iconSize('lg')->hiddenLabel(),
                Tables\Actions\DeleteAction::make()->iconSize('lg')->hiddenLabel(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->headerActions([
                Tables\Actions\Action::make('pdf')
                    ->label('Website QRCode')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($record) {
                        if (!File::exists(\public_path('storage\qrcode.png'))) {
                            QRCode::url(\env('APP_URL'))
                                ->setOutfile(Storage::disk("public")->path("qrcode.png"))
                                ->png();
                        }
                        return response()->streamDownload(function () {
                            if (File::exists(public_path('storage\qrcode.png'))) {
                                echo Pdf::loadHTML(
                                    Blade::render('qr-code')
                                )->stream();
                            } else {
                                echo 'error';
                            }
                        }, 'website-qr-code.pdf');
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
