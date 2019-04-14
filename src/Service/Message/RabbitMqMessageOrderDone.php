<?php

namespace App\Service\Message;

/**
 * LISTENS for order ids on queue order_done
 *
 * Class RabbitMqMessageOrderDone
 * @package App\Service
 */
class RabbitMqMessageOrderDone
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }
}
