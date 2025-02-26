<?php

namespace App\Factory;

use App\BusinessLogic\Models\Child;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class ChildFactory extends PersistentProxyObjectFactory
{


    public static function class(): string
    {
        return Child::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->text(),
        ];
    }

}
