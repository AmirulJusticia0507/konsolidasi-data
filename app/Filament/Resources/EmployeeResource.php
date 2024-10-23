<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // Form schema for creating and editing employees
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Employee ID: Readonly and auto-generated
                Forms\Components\TextInput::make('employee_id')
                    ->default(fn() => 'EMP-' . strtoupper(uniqid()))  // Generate random employee ID
                    ->disabled()  // Prevent users from editing the field
                    ->label('Employee ID'),
                
                Forms\Components\TextInput::make('firstname')
                    ->required()
                    ->label('First Name'),
                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->label('Last Name'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(Employee::class, 'email')
                    ->label('Email'),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->label('Gender'),
                Forms\Components\TextInput::make('username')
                    ->required()
                    ->unique(Employee::class, 'username')
                    ->label('Username'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->label('Password'),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Phone Number'),
                Forms\Components\TextInput::make('city')
                    ->label('City'),
                Forms\Components\TextInput::make('state')
                    ->label('State'),
                Forms\Components\TextInput::make('zip_code')
                    ->label('Zip Code'),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->label('Date of Birth'),
                Forms\Components\TextInput::make('job_title')
                    ->label('Job Title'),
            ]);
    }

    // Table schema for displaying employees
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee_id')->label('Employee ID')->sortable(),
                Tables\Columns\TextColumn::make('firstname')->label('First Name')->sortable(),
                Tables\Columns\TextColumn::make('lastname')->label('Last Name')->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->sortable(),
                Tables\Columns\TextColumn::make('gender')->label('Gender'),
                Tables\Columns\TextColumn::make('username')->label('Username'),
                Tables\Columns\TextColumn::make('phone_number')->label('Phone Number'),
                Tables\Columns\TextColumn::make('job_title')->label('Job Title'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created At')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Resource page routes
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
