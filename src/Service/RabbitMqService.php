<?php

namespace App\Service;

use App\Service\Message\RabbitMqMessageShipment;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Managing sending Shipment info
 *
 * Class RabbitMqService
 * @package App\Service
 */
class RabbitMqService
{
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function send($message)
    {
        $this->bus->dispatch(new RabbitMqMessageShipment($message));
    }
}
