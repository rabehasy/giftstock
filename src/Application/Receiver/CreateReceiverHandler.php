<?php

namespace App\Application\Receiver;

use App\Domain\Receiver\Receiver;
use App\Domain\Receiver\ReceiverRepositoryInterface;

class CreateReceiverHandler
{
    private ReceiverRepositoryInterface $receiverRepository;

    public function __construct(ReceiverRepositoryInterface $receiverRepository)
    {
        $this->receiverRepository = $receiverRepository;
    }

    public function handle(array $item): Receiver
    {
        $receiver = new Receiver();
        $receiver->setFirstName($item['first_name']);
        $receiver->setLastName($item['last_name']);
        $receiver->setCountryCode($item['country_code']);

        try {
            $this->receiverRepository->save($receiver);
        } catch (\Exception $exception) {
            throw new \Exception('unable to save receiver '.$exception->getMessage());
        }

        return $receiver;
    }
}
