<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::updateOrCreate(
    ['email' => 'user@test.com'],
    [
        'name' => 'Test Jamaah',
        'password' => Hash::make('12345678'),
        'role' => 'user',
    ]
);

echo 'User created/updated: ' . $user->email . ' | ID: ' . $user->id . PHP_EOL;
