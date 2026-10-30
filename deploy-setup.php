<?php
/**
 * Deployment Setup Script for Infinity Free
 * Access via: https://sitani.infinityfree.io/deploy-setup.php
 * 
 * SECURITY: Delete this file after running!
 */

// Check if accessed via POST (prevent accidental GET requests)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('❌ Access denied. Use POST request only.');
}

// Security check - simple token
$token = $_POST['token'] ?? '';
if ($token !== 'sitani2026deploy') {
    die('❌ Invalid token.');
}

echo "<pre>";
echo "=== SITANI Deployment Setup ===\n\n";

try {
    // Change to app root
    $appRoot = dirname(__DIR__);
    chdir($appRoot);
    
    // Load Laravel
    require $appRoot . '/vendor/autoload.php';
    $app = require_once $appRoot . '/bootstrap/app.php';
    
    // 1. Run migrations
    echo "[1/3] Running migrations...\n";
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $exitCode = $kernel->call('migrate', ['--force' => true]);
    echo "✅ Migrations completed (exit code: $exitCode)\n\n";
    
    // 2. Clear cache
    echo "[2/3] Clearing cache...\n";
    $kernel->call('cache:clear');
    $kernel->call('config:clear');
    $kernel->call('view:clear');
    echo "✅ Cache cleared\n\n";
    
    // 3. Optimize
    echo "[3/3] Optimizing...\n";
    $kernel->call('optimize:clear');
    $kernel->call('optimize');
    echo "✅ Optimization complete\n\n";
    
    echo "=== ✅ Deployment setup completed! ===\n";
    echo "⚠️  DELETE this file (deploy-setup.php) for security!\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

echo "</pre>";
?>
