<?php

namespace FreezLike\MaintenanceBundle\Service;

use Symfony\Component\Security\Core\Security;

class MaintenanceManager
{
    private bool $active;
    private ?string $nextMaintenanceDate;
    private string $allowedRole;
    private Security $security;

    public function __construct(bool $active, ?string $nextMaintenanceDate, string $allowedRole, Security $security)
    {
        $this->active = $active;
        $this->nextMaintenanceDate = $nextMaintenanceDate;
        $this->allowedRole = $allowedRole;
        $this->security = $security;
    }

    public function isUnderMaintenance(): bool
    {
        if (!$this->active) {
            return false;
        }

        $user = $this->security->getUser();
        if ($user && $this->security->isGranted($this->allowedRole)) {
            return false;
        }

        return true;
    }

    public function getNextMaintenanceDate(): ?string
    {
        return $this->nextMaintenanceDate;
    }
}
