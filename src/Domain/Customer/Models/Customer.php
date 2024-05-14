<?php

declare(strict_types=1);

namespace Domain\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'resource_id',
        'phone_number',
        'status',
    ];

    public function getRouteKeyName(): string
    {
        return 'resource_id';
    }
}
