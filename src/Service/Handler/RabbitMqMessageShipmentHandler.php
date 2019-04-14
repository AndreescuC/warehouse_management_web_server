<?php

namespace App\Service\Handler;

use App\Service\Message\RabbitMqMessageShipment;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RabbitMqMessageShipmentHandler implements MessageHandlerInterface
{
    public function __invoke(RabbitMqMessageShipment $message){}
}