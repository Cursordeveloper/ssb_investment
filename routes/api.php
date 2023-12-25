<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Routes without {customer} parameter
Route::prefix('v1/investment')
    ->as('v1:investment.')
    ->group(base_path('routes/v1/common.php'));

// Routes with {customer} parameter
Route::prefix('v1/investment/customers/{customer}')
    ->as('v1:investment.customers.')
    ->group(base_path('routes/v1/main.php'))
    ->whereUuid(
        parameters: ['customer'],
    );
