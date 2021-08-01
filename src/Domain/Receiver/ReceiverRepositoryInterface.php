<?php

namespace App\Domain\Receiver;

interface ReceiverRepositoryInterface
{
    public function save(Receiver $receiver): void;
}
