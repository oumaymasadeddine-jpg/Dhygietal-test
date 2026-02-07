<?php

namespace App\MessageHandler;

use App\Message\ProductUpdatedMessage;
use App\Entity\ProductLog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ProductUpdatedMessageHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(ProductUpdatedMessage $message): void
    {
        $log = new ProductLog();
        $log->setProductId($message->getProductId());
        $log->setAction($message->getAction());

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }
}