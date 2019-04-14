<?php

namespace App\Service\Handler;

use App\Database\Adaptor;
use App\Dto\OrderHeaderDto;
use App\Service\Message\RabbitMqMessageOrderDone;
use App\Service\RabbitMqService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RabbitMqMessageOrderDoneHandler implements MessageHandlerInterface
{
    private $rabbitService;
    private $dbAdaptor;

    public function __construct(RabbitMqService $rabbitService, Adaptor $dbAdaptor)
    {
        $this->rabbitService = $rabbitService;
        $this->dbAdaptor     = $dbAdaptor;
    }

    public function __invoke(RabbitMqMessageOrderDone $message)
    {
        $orderId = (int)$message->content[0];
        $source  = $message->content[1];

        $this->dbAdaptor->markOneAs('order_header', $orderId, OrderHeaderDto::STATUS_DONE);
        if ($source == 'returned') {
            $this->dbAdaptor->setReturn($orderId);
        }
    }
}