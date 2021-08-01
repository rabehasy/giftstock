<?php

namespace App\Application\Gift;

use App\Domain\Gift\Gift;
use App\Domain\Gift\GiftRepositoryInterface;

class CreateGiftHandler
{
    private GiftRepositoryInterface $giftRepository;

    public function __construct(GiftRepositoryInterface $giftRepository)
    {
        $this->giftRepository = $giftRepository;
    }

    public function handle(array $item): void
    {
        $gift = new Gift();
        $gift->setCode($item['code']);
        $gift->setDescription($item['description']);
        $gift->setPrice($item['price']);

        try {
            $this->giftRepository->save($gift);
        } catch (\Exception $exception) {
            throw new \Exception('unable to save gift '.$exception->getMessage());
        }
    }
}
