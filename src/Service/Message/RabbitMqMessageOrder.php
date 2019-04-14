<?php

namespace App\Service\Message;

/**
 * LISTENS to shipment ids on queue order
 *
 * Class RabbitMqMessageOrder
 * @package App\Service
 */
class RabbitMqMessageOrder
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }
}
