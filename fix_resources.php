<?php
$files = glob("app/Filament/Resources/*.php");

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // 1. Schema -> Form
    $content = str_replace('use Filament\Schemas\Schema;', 'use Filament\Forms\Form;', $content);
    $content = str_replace('public static function form(Schema $schema): Schema', 'public static function form(Form $form): Form', $content);
    $content = str_replace('return $schema', 'return $form', $content);
    $content = str_replace('->components([', '->schema([', $content);
    
    // 2. Icon Enum -> String
    $content = str_replace('use Filament\Support\Icons\Heroicon;', '', $content);
    $content = preg_replace("/protected static string\|BackedEnum\|null \\\$navigationIcon = Heroicon::([A-Za-z0-9_]+);/", "protected static ?string \$navigationIcon = 'heroicon-o-$1';", $content);
    $content = str_replace('heroicon-o-Outlined', 'heroicon-o-', $content);
    $content = preg_replace_callback("/'heroicon-o-([A-Za-z0-9_]+)'/", function($matches) {
        // Convert PascalCase to kebab-case
        $kebab = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $matches[1]));
        return "'heroicon-o-" . $kebab . "'";
    }, $content);
    
    // 3. Navigation Group type
    $content = preg_replace("/protected static \\\UnitEnum\|string\|null \\\$navigationGroup = (.*?);/", "protected static ?string \$navigationGroup = $1;", $content);
    
    // 4. Actions
    $content = str_replace('use Filament\Actions\EditAction;', 'use Filament\Tables\Actions\EditAction;', $content);
    $content = str_replace('use Filament\Actions\DeleteAction;', 'use Filament\Tables\Actions\DeleteAction;', $content);
    $content = str_replace('use Filament\Actions\Action;', 'use Filament\Tables\Actions\Action;', $content);
    $content = str_replace('->recordActions([', '->actions([', $content);
    
    // 5. BackedEnum
    $content = str_replace('use BackedEnum;' . "\n", '', $content);
    $content = str_replace('use BackedEnum;' . "\r\n", '', $content);
    
    file_put_contents($file, $content);
}
echo "Fixes applied to " . count($files) . " resources.\n";
