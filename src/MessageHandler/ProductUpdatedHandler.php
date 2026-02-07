<?php

namespace App\MessageHandler;

use App\Message\ProductUpdated;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ProductUpdatedHandler
{
    public function __invoke(ProductUpdated $message): void
    {
        // do something with your message
    }
}
