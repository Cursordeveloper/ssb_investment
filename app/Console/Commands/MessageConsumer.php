<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\RabbitMQ\RabbitMQService;
use Illuminate\Console\Command;

final class MessageConsumer extends Command
{
    protected $signature = 'app:message-consumer';

    public function handle(): void
    {
        $rabbitMQService = new RabbitMQService;
        $rabbitMQService->consume(exchange: 'ssb_direct', type: 'direct', queue: 'investment', routingKey: 'ssb_inv', callback: function ($message) {
        });
    }
}
