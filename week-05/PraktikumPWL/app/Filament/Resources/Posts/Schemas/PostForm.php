<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // GROUP KIRI (2/3 Lebar)
                Group::make([
                    Section::make("Post Details")
                        ->description("Isi detail utama postingan di sini")
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            TextInput::make("title")
                                ->required() 
                                ->minLength(5) 
                                ->maxLength(255),
                            
                            TextInput::make("slug")
                                ->required()
                                ->unique(ignoreRecord: true) 
                                ->validationMessages([
                                    'unique' => 'Wah, Slug ini sudah terpakai!', 
                                ]),

                            Select::make("category_id")
                                ->relationship("category", "name")
                                ->required()
                                ->preload(),
                            ColorPicker::make("color"),
                            MarkdownEditor::make("content")
                                ->columnSpanFull(),
                        ])->columns(2), 
                ])->columnSpan(2),

                // GROUP KANAN (1/3 Lebar)
                Group::make([
                    Section::make("Image Upload")
                        ->schema([
                            FileUpload::make("image")
                                ->required() 
                                ->disk("public")
                                ->directory("posts"),
                        ]),
                    Section::make("Meta Information")
                        ->schema([
                            TagsInput::make("tags"),
                            Checkbox::make("published"),
                            DateTimePicker::make("published_at")
                                ->default(now()),
                        ]),
                ])->columnSpan(1),
            ])
            ->columns(3); // Fondasi grid utama dibagi 3
    }
}
