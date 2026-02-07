<?php

namespace App\EventListener;

use App\Entity\Product;
use App\Message\ProductUpdatedMessage;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(event: Events::postPersist, entity: Product::class)]
#[AsEntityListener(event: Events::postUpdate, entity: Product::class)]
class ProductEventListener
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function postPersist(Product $product): void
    {
        $this->messageBus->dispatch(
            new ProductUpdatedMessage($product->getId(), 'created')
        );
    }

    public function postUpdate(Product $product): void
    {
        $this->messageBus->dispatch(
            new ProductUpdatedMessage($product->getId(), 'updated')
        );
    }
}