<?php

namespace App\Factory;

use App\Entity\Product;
use App\Entity\Category;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class ProductFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Product::class;
    }

    protected function defaults(): array
    {
        return [
            'designation' => self::faker()->unique()->words(3, true),
        ];
    }

    protected function initialize(): static
    {
        return $this
            ->afterInstantiate(function(Product $product): void {
                $categories = CategoryFactory::randomRange(1, 3);
                foreach ($categories as $category) {
                    $product->addCategory($category->_real());
                }
            })
        ;
    }
}