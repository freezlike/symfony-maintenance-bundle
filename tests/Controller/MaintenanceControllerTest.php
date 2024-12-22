<?php

namespace MyVendor\MaintenanceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MaintenanceControllerTest extends WebTestCase
{
    public function testMaintenancePage()
    {
        $client = static::createClient();
        $client->request('GET', '/maintenance');
        $this->assertResponseStatusCodeSame(200);
    }
}
