<?php

namespace App\Domain\Gift;

interface GiftRepositoryInterface
{
    public function save(Gift $gift): void;
}
