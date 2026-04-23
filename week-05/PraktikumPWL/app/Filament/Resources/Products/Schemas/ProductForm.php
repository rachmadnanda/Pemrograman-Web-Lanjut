<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Checkbox;
use Filament\Actions\Action;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // STEP 1: INFORMASI PRODUK
                    Step::make('Product Info')
                        ->description('Isi informasi dasar produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')
                                ->columnSpanFull(),
                        ]),

                    // STEP 2: HARGA & STOK
                    Step::make('Pricing & Stock')
                        ->description('Isi harga dan jumlah stok')
                        ->schema([
                            TextInput::make('price')
                                ->numeric()
                                ->required(),
                            TextInput::make('stock')
                                ->numeric()
                                ->required(),
                        ]),

                    // STEP 3: MEDIA & STATUS
                    Step::make('Media & Status')
                        ->description('Upload gambar dan atur status')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('products'),
                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured'),
                        ]),
                ])
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->color('primary')
                        ->submit('save')
                ),
            ]);
    }
}