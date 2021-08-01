<?php

namespace App\Infrastructure\Messenger;

use App\Application\Gift\CreateGiftHandler;
use App\Application\Receiver\CreateReceiverHandler;
use App\Domain\Gift\Gift;
use App\Domain\Gift\UploadedGiftMessage;
use App\Domain\Receiver\Receiver;
use App\Infrastructure\Doctrine\GiftRepository;
use App\Infrastructure\Doctrine\ReceiverRepository;
use Doctrine\Persistence\ManagerRegistry;
use League\Csv\Reader;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UploadedGiftMessageHandler implements MessageHandlerInterface
{
    private CreateGiftHandler $giftHandler;

    private CreateReceiverHandler $receiverHandler;

    private GiftRepository $giftRepository;

    private ReceiverRepository $receiverRepository;

    private ManagerRegistry $managerRegistry;

    public function __construct(CreateGiftHandler $giftHandler, CreateReceiverHandler $receiverHandler, GiftRepository $giftRepository, ReceiverRepository $receiverRepository, ManagerRegistry $managerRegistry)
    {
        $this->giftHandler = $giftHandler;
        $this->giftRepository = $giftRepository;
        $this->receiverRepository = $receiverRepository;
        $this->managerRegistry = $managerRegistry;
        $this->receiverHandler = $receiverHandler;
    }

    public function __invoke(UploadedGiftMessage $uploadedGiftMessage): void
    {
        $filename = $uploadedGiftMessage->getFilename();
        $targetDirectory = $uploadedGiftMessage->getTargetDirectory();

        $csv = Reader::createFromPath($targetDirectory.'/'.$filename, 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(';');

        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

        if (1 === count($header)) {
            $csv->setDelimiter(',');
            $header = $csv->getHeader(); //returns the CSV header record
            $records = $csv->getRecords();
        }

        if (1 === count($header)) {
            throw new \Exception('Separator file must be ; or ,');
        }

        foreach ($records as $record) {
            $giftUuid = $record['gift_uuid'] ?? '';
            $giftCode = $record['gift_code'] ?? '';
            $giftDescription = $record['gift_description'] ?? '';
            $giftPrice = $record['gift_price'] ?? 0;

            $receveirUuid = $record['receiver_uuid'] ?? '';
            $receiverFirstName = $record['receiver_first_name'] ?? '';
            $receiverLastName = $record['receiver_last_name'] ?? '';
            $countryCode = $record['receiver_country_code'] ?? '';

            // Save gift
            $gift = $this->createGift([
                'uuid' => $giftUuid,
                'code' => $giftCode,
                'description' => $giftDescription,
                'price' => $giftPrice,
            ]);

            // Save Receiver
            $receiver = $this->createReceiver([
                'uuid' => $receveirUuid,
                'first_name' => $receiverFirstName,
                'last_name' => $receiverLastName,
                'country_code' => $countryCode,
            ]);

            // add gift to receiver
            $gift->addReceiver($receiver);
            $this->managerRegistry->getManager()->flush();
        }
    }

    private function createGift(array $array): Gift
    {
        // Find if exists
        $gift = $this->giftRepository->find($array['uuid']);
        if (null != $gift) {
            return $gift;
        }

        // Save if not exists
        return $this->giftHandler->handle($array);
    }

    private function createReceiver(array $array): Receiver
    {
        // Find if exists
        $receiver = $this->receiverRepository->find($array['uuid']);
        if (null != $receiver) {
            return $receiver;
        }

        // Save if not exists
        return $this->receiverHandler->handle($array);
    }
}
