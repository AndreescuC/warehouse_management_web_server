<?php

namespace App\Service\Handler;

use App\Database\Adaptor;
use App\Service\Message\RabbitMqMessageOrder;
use App\Service\RabbitMqService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RabbitMqMessageOrderHandler implements MessageHandlerInterface
{
    private $rabbitService;
    private $dbAdaptor;

    public function __construct(RabbitMqService $rabbitService, Adaptor $dbAdaptor)
    {
        $this->rabbitService = $rabbitService;
        $this->dbAdaptor     = $dbAdaptor;
    }

    public function __invoke(RabbitMqMessageOrder $message)
    {
        $shipmentId = (int)$message->content;
        $orders = $this->dbAdaptor->getOrdersByShipment($shipmentId);

        $this->rabbitService->send(['orders' => $orders]);
    }
}