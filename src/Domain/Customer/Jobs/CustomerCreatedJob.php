<?php

declare(strict_types=1);

namespace Domain\Customer\Jobs;

use Domain\Customer\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CustomerCreatedJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public readonly array $request)
    {
    }

    public function handle(): void
    {
        // Create the Customer
        $create_customer = Customer::updateOrCreate([
            'phone_number' => data_get(
                target: $this->request,
                key: 'data.attributes.phone_number'
            ),
        ], [
            'id' => data_get(
                target: $this->request,
                key: 'data.id'
            ),
            'resource_id' => data_get(
                target: $this->request,
                key: 'data.attributes.resource_id'
            ),
            'phone_number' => data_get(
                target: $this->request,
                key: 'data.attributes.phone_number'
            ),
            'status' => data_get(
                target: $this->request,
                key: 'data.attributes.status'
            ),
        ]);

        // Log the error if any
        if (! $create_customer) {
            logger();
        }
    }
}
