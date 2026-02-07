<?php

namespace App\Story;

use App\Factory\CategoryFactory;
use App\Factory\ProductFactory;
use Zenstruck\Foundry\Story;

final class DefaultStory extends Story
{
    public function build(): void
    {
        // Create 5 categories first
        CategoryFactory::createMany(5);

        // Create 10 products (categories auto-assigned via afterInstantiate)
        ProductFactory::createMany(10);
    }
}