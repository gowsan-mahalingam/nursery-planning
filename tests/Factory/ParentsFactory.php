<?php

namespace App\Tests\Factory;

use App\BusinessLogic\Models\Parents;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;


final class ParentsFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Parents::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->email(),
            'plainPassword' => self::faker()->password(),
            'password' => self::faker()->password()
        ];
    }



}
