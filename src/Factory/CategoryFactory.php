<?php

namespace App\Factory;

use App\Entity\Category;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class CategoryFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Category::class;
    }

    protected function defaults(): array
    {
        return [
            'designation' => self::faker()->unique()->randomElement([
                'Electronics',
                'Books',
                'Clothing',
                'Food',
                'Sports'
            ]),
        ];
    }
}