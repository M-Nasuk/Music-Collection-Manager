<?php


namespace App\Service;


use App\Gateway\GatewayInterface;

interface MediaFinderInterface
{
    public function __construct(GatewayInterface $gateway);

}