<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require_once 'api.php';

Route::get('/', function () {
    return Inertia::render('Index');
});

