<?php
$files = glob("app/Filament/Resources/*.php");
foreach ($files as $file) {
    $content = file_get_contents($file);
    $content = str_replace('use Filament\Forms\Get;', 'use Filament\Schemas\Components\Utilities\Get;', $content);
    $content = str_replace('use Filament\Forms\Set;', 'use Filament\Schemas\Components\Utilities\Set;', $content);
    file_put_contents($file, $content);
}
echo "Get/Set namespace fixed.\n";
