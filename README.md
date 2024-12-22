# Maintenance Bundle

## Introduction

The **Maintenance Bundle** is a Symfony bundle that allows you to manage maintenance mode for your Symfony application. 
It includes configurable parameters such as whether maintenance mode is active, the date of the next scheduled maintenance, 
and a role that can bypass maintenance restrictions. This bundle is lightweight, easy to configure, and customizable.

## Features

- Activate or deactivate maintenance mode via configuration.
- Display the next scheduled maintenance date to users.
- Allow users with specific roles to bypass maintenance mode.
- Highly configurable and easy to integrate into your Symfony application.

## Requirements

- PHP 8.0 or higher
- Symfony 5.0 or higher

## Installation

1. Install the bundle via Composer:

   ```bash
   composer require freezlike/maintenance-bundle
   ```

2. Enable the bundle in your `config/bundles.php` file (if not automatically added):

   ```php
   return [
       // ...
       FreezLike\MaintenanceBundle\MaintenanceBundle::class => ['all' => true],
   ];
   ```

3. Configure the bundle in your Symfony application:

   Add the following configuration to your `config/packages/maintenance.yaml` file:

   ```yaml
   maintenance:
       active: false
       next_maintenance_date: null
       allowed_role: 'ROLE_ADMIN'
   ```

4. Clear the cache:

   ```bash
   php bin/console cache:clear
   ```

## Usage

### Activating Maintenance Mode

To activate maintenance mode, set the `active` parameter to `true` in the configuration file:

```yaml
maintenance:
    active: true
    next_maintenance_date: '2024-12-31 23:59:59'
    allowed_role: 'ROLE_ADMIN'
```

Users without the specified `allowed_role` will see a maintenance message when trying to access the application.

### Displaying Maintenance Information

You can use the `MaintenanceManager` service in your controllers or templates to display the next maintenance date:

```php
<?php
namespace App\Controller;

use FreezLike\MaintenanceBundle\Service\MaintenanceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    private MaintenanceManager $maintenanceManager;

    public function __construct(MaintenanceManager $maintenanceManager)
    {
        $this->maintenanceManager = $maintenanceManager;
    }

    public function index(): Response
    {
        $nextMaintenanceDate = $this->maintenanceManager->getNextMaintenanceDate();
        return $this->render('default/index.html.twig', [
            'nextMaintenanceDate' => $nextMaintenanceDate,
        ]);
    }
}
```

### Event Listener

The bundle includes an event listener that handles maintenance mode automatically by returning a 503 response when the site is under maintenance.

## Contribution

Contributions are welcome!

1. Fork the repository on GitHub.
2. Create a new branch for your feature or bug fix.
3. Submit a pull request with a clear explanation of your changes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

---

**Happy Coding!**
