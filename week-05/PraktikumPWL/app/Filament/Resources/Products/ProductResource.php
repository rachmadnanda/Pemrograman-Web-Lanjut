<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->vertical()
                    ->tabs([
                        Tabs\Tab::make('Product Info')
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                TextEntry::make('name')->label('Nama Produk'),
                                TextEntry::make('sku')->label('SKU'),
                                TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                            ])->columns(2),

                        Tabs\Tab::make('Pricing & Stock')
                            ->icon('heroicon-m-currency-dollar')
                            ->schema([
                                TextEntry::make('price')->label('Harga')->money('IDR'),
                                TextEntry::make('stock')->label('Stok')->badge(),
                            ])->columns(2),

                        Tabs\Tab::make('Media & Status')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                ImageEntry::make('image')->label('Gambar'),
                                IconEntry::make('is_active')
                                    ->label('Status Aktif')
                                    ->boolean(),
                            ])->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => \App\Filament\Resources\Products\Pages\ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
