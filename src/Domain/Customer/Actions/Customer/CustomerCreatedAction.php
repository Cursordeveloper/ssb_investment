<?php

declare(strict_types=1);

namespace Domain\Customer\Actions\Customer;

use Domain\Customer\Jobs\CustomerCreatedJob;

final class CustomerCreatedAction
{
    public static function execute(array $request): void
    {
        // Dispatch the CustomerCreatedJob
        CustomerCreatedJob::dispatch($request);
    }
}
