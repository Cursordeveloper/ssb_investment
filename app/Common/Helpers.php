<?php

declare(strict_types=1);

namespace App\Common;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class Helpers
{
    public function generateAccountNumber(): string
    {
        do {
            $number = (string) mt_rand(100000000000, 999999999999);
        } while (! empty(DB::table(table: 'susus')->where(column: 'account_number', operator: $number)->first(['account_number'])));

        return $number;
    }

    public function calculateDebit(float $amount, string $frequency, string $duration): float
    {
        $totalDays = $this->getDaysInDuration($duration);

        return match (strtolower($frequency)) {
            'weekly' => round($amount / floor($totalDays / 7), 2),
            'monthly' => round($amount / floor($totalDays / 30), 2),
            default => round($amount / $totalDays, 2),
        };
    }

    public function calculateDate(string $date): string
    {
        $today = date(format: 'Y-m-d');

        return match (strtolower($date)) {
            'next-week' => date(format: 'Y-m-d', timestamp: strtotime(datetime: $today.' +1 week')),
            'two-weeks' => date(format: 'Y-m-d', timestamp: strtotime(datetime: $today.' +2 week')),
            'next-month' => date(format: 'Y-m-d', timestamp: strtotime(datetime: $today.' +1 month')),
            default => $today,
        };
    }

    public function getEndCollectionDate(): Carbon
    {
        $currentDate = Carbon::now();

        return $currentDate->addYears(value: 10);
    }

    private function getDaysInDuration(string $date): int
    {
        return match (strtolower($date)) {
            'one-month' => 30,
            'three-months' => 90,
            'six-months' => 180,
            'nine-months' => 270,
            default => 365,
        };
    }
}
