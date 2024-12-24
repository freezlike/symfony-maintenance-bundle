<?php

namespace FreezLike\MaintenanceBundle\EventListener;

use FreezLike\MaintenanceBundle\Service\MaintenanceManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

class MaintenanceListener
{
    private MaintenanceManager $maintenanceManager;
    private Environment $twig;
    private Security $security;

    public function __construct(MaintenanceManager $maintenanceManager, Environment $twig, Security $security)
    {
        $this->maintenanceManager = $maintenanceManager;
        $this->twig = $twig;
        $this->security = $security;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if ($this->maintenanceManager->isUnderMaintenance()) {
            $nextMaintenanceDate = $this->maintenanceManager->getNextMaintenanceDate();
            $content = $this->twig->render('@Maintenance/maintenance.html.twig', [
                'nextMaintenanceDate' => $nextMaintenanceDate,
            ]);

            $response = new Response($content, 503);
            $event->setResponse($response);
        }
    }
}
