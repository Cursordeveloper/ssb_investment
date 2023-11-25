<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('v1/investment')
    ->as('v1.investment:')
    ->group(base_path('routes/v1/routes.php'));
