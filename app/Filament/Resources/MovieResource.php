<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Movie;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MovieResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MovieResource\RelationManagers;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // --- COLUMNAS PRINCIPALES ---
                TextInput::make('title')
                    ->label('Título de la Película')
                    ->required()
                    ->maxLength(255)
                    // Se genera un slug/placeholder basado en el título (necesitas crear la columna 'slug' si quieres usar la función de ruteo amigable)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null) // Esto solo es útil si creas la columna 'slug'
                    ->columnSpanFull(), // Ocupa todo el ancho

                Textarea::make('description')
                    ->label('Sinopsis')
                    ->rows(4)
                    ->maxLength(65535) // Usa el límite de TEXT
                    ->nullable()
                    ->columnSpanFull(),

                // --- METADATOS Y FECHAS ---
                DatePicker::make('release_date')
                    ->label('Fecha de Estreno')
                    ->nullable()
                    ->maxDate(now()), // No permite fechas futuras

                TextInput::make('duration')
                    ->label('Duración (Minutos)')
                    ->numeric()
                    ->rules(['nullable', 'integer', 'min:1']),

                // --- ARCHIVOS Y URLS ---
                // Campo para el Póster (Columna 'image')
                FileUpload::make('image')
                    ->label('Póster de la Película (Imagen Principal)')
                    ->disk('public')
                    ->directory('posters')
                    ->image()
                    ->required() // Asumimos que la imagen es crucial
                    ->maxSize(2048), // Límite de 2MB

                TextInput::make('trailer_url')
                    ->label('URL del Trailer (Ej: YouTube)')
                    ->url() // Valida que sea una URL
                    ->maxLength(255)
                    ->nullable(),


                // --- NUEVO CAMPO DE PUBLICACIÓN ---
                Toggle::make('is_published') // EL NOMBRE DEBE COINCIDIR CON LA COLUMNA
                    ->label('Publicar en el Catálogo (ON/OFF)')
                    ->helperText('Si está desactivado, esta película no aparecerá en ninguna parte del sitio web público.')
                    ->default(true), // Puedes dejarlo como true o false, dependiendo de tu flujo de trabajo
                // --- TOGGLES DE CATEGORÍA ---
                Toggle::make('is_trending')
                    ->label('Mostrar en Tendencias')
                    ->default(false),

                Toggle::make('is_new')
                    ->label('Mostrar como Novedad')
                    ->default(true),
            ])
            ->columns(2); // Organiza los campos en dos columnas
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Póster')
                    ->disk('public')
                    ->height(80), // Tamaño para la vista de tabla

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => Str::limit($record->description, 30)), // Muestra un extracto de la descripción

                TextColumn::make('release_date')
                    ->label('Estreno')
                    ->date()
                    ->sortable(),

                TextColumn::make('duration')
                    ->label('Duración (min)')
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Publicada')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_trending')
                    ->label('Tendencia')
                    ->boolean(),

                IconColumn::make('is_new')
                    ->label('Novedad')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Oculto por defecto
            ])
            ->filters([
                // Puedes añadir filtros aquí
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
