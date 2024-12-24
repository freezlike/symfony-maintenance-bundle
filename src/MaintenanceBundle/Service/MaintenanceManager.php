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
        // dd($user);
        if ($user && $this->security->isGranted($this->allowedRole)) {
            return false;
        }

        return true;
    }

    public function getNextMaintenanceDateOld(): ?string
    {
        return $this->nextMaintenanceDate;
    }

    public function getNextMaintenanceDate(): ?\DateTime
    {
        $date =  $this->nextMaintenanceDate ?? null;

        if ($date === null) {
            return null;
        }

        // Convertir en \DateTime si ce n'est pas déjà un objet
        if (is_string($date)) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                // $this->logger->error('Invalid next_maintenance_date format: ' . $date);
                return null;
            }
        }

        // Vérifier si la date est inférieure à aujourd'hui
        $now = new \DateTime();
        if ($date < $now) {
            return null;
        }

        return $date;
    }
    public function getFormattedNextMaintenanceDate(): ?string
    {
        try {
            $nextDate = \Datetime::createFromFormat($this->getNextMaintenanceDate(), 'Y-m-d H:i');
            return $nextDate ? $nextDate->format('l, F j, Y \a\t H:i') : null;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
