<?php

namespace App\Message;

final class ProductUpdated
{
    public function __construct(
        private int $productId,
        private string $action
    ) {
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}