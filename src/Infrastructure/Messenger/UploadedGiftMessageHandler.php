<?php

namespace App\Infrastructure\Messenger;

use App\Domain\Gift\UploadedGiftMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UploadedGiftMessageHandler implements MessageHandlerInterface
{
    public function __invoke(UploadedGiftMessage $uploadedGiftMessage): void
    {
        $filename = $uploadedGiftMessage->getFilename();
    }
}
