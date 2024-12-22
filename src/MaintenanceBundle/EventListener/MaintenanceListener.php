<?php

namespace FreezLike\MaintenanceBundle\EventListener;

use FreezLike\MaintenanceBundle\Service\MaintenanceManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class MaintenanceListener
{
    private MaintenanceManager $maintenanceManager;

    public function __construct(MaintenanceManager $maintenanceManager)
    {
        $this->maintenanceManager = $maintenanceManager;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if ($this->maintenanceManager->isUnderMaintenance()) {
            $response = new Response('The site is under maintenance.', 503);
            $event->setResponse($response);
        }
    }
}
