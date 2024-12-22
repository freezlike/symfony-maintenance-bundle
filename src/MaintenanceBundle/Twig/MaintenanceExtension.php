<?php

namespace FreezLike\MaintenanceBundle\Twig;

use FreezLike\MaintenanceBundle\Service\MaintenanceManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MaintenanceExtension extends AbstractExtension
{
    private MaintenanceManager $maintenanceManager;

    public function __construct(MaintenanceManager $maintenanceManager)
    {
        $this->maintenanceManager = $maintenanceManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('next_maintenance_date', [$this, 'getNextMaintenanceDate']),
        ];
    }

    public function getNextMaintenanceDate(): ?string
    {
        return $this->maintenanceManager->getFormattedNextMaintenanceDate();
    }
}
