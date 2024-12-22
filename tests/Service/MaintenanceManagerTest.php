<?php

namespace MyVendor\MaintenanceBundle\Tests\Service;

use MyVendor\MaintenanceBundle\Service\MaintenanceManager;
use PHPUnit\Framework\TestCase;

class MaintenanceManagerTest extends TestCase
{
    public function testIsMaintenanceActive()
    {
        $manager = new MaintenanceManager(false, '2024-12-31 23:59:59', 'ROLE_ADMIN');
        $this->assertFalse($manager->isMaintenanceActive());
    }
}
