<?php

use Spatie\Enum\Laravel\Enum;

class AddressOrigin extends Enum
{
    protected static function values(): array
    {
        return [
            'USER' => 1,
            'RESCUE' => 2,
            'ORGANIZATION' => 3,
        ];
    }
}
