<?php

namespace App\PageTemplates;

use Filament\Forms;

class HomePage
{
    public static function fields(): array
    {
        return [
            Forms\Components\TextInput::make('headline')
                ->required()
                ->label('Headline'),
            Forms\Components\Textarea::make('description')
                ->label('Description'),
            Forms\Components\FileUpload::make('image')
                ->label('Image')
                ->image()
                ->disk('public')
                ->directory('images')
                ->enableDownload() 
                ->required(false),
        ];
    }
}
