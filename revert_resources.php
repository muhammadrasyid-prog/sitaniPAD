<?php
$files = glob("app/Filament/Resources/*.php");

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // 1. Form -> Schema
    $content = str_replace('use Filament\Forms\Form;', 'use Filament\Schemas\Schema;', $content);
    $content = str_replace('public static function form(Form $form): Form', 'public static function form(Schema $schema): Schema', $content);
    $content = str_replace('return $form', 'return $schema', $content);
    $content = str_replace('->schema([', '->components([', $content);
    
    // 2. Icon Enum
    // We lost the exact icon enum name, but we can extract it from the string
    $content = preg_replace_callback("/protected static \?string \\\$navigationIcon = 'heroicon-o-([a-z0-9-]+)';/", function($matches) {
        $pascal = str_replace('-', '', ucwords($matches[1], '-'));
        return "protected static string|BackedEnum|null \$navigationIcon = Heroicon::Outlined" . $pascal . ";";
    }, $content);
    $content = str_replace('namespace App\Filament\Resources;', "namespace App\Filament\Resources;\n\nuse BackedEnum;\nuse Filament\Support\Icons\Heroicon;", $content);
    
    // 3. Navigation Group type
    $content = preg_replace("/protected static \?string \\\$navigationGroup = (.*?);/", "protected static \UnitEnum|string|null \$navigationGroup = $1;", $content);
    
    // 4. Actions
    $content = str_replace('use Filament\Tables\Actions\EditAction;', 'use Filament\Actions\EditAction;', $content);
    $content = str_replace('use Filament\Tables\Actions\DeleteAction;', 'use Filament\Actions\DeleteAction;', $content);
    $content = str_replace('use Filament\Tables\Actions\Action;', 'use Filament\Actions\Action;', $content);
    $content = str_replace('->actions([', '->recordActions([', $content);
    
    file_put_contents($file, $content);
}
echo "Reverted fixes in " . count($files) . " resources.\n";
