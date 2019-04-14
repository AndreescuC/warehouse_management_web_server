<?php

namespace App\Service\Message;

/**
 * SENDS shipment orders info on queue shipment
 *
 * Class RabbitMqMessageShipment
 * @package App\Service
 */
class RabbitMqMessageShipment
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }
}
