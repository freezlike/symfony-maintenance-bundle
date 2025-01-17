
# Maintenance Bundle

## Introduction

The **Maintenance Bundle** is a Symfony bundle for managing maintenance mode in your application. 
It provides the ability to schedule maintenance, notify users about upcoming maintenance, and allow specific roles to bypass maintenance mode.

## Features

- Activate or deactivate maintenance mode.
- Display the next maintenance date.
- Notify users about upcoming maintenance via a global notification.
- Allow specific roles to bypass maintenance mode.

## Requirements

- PHP 8.0 or higher
- Symfony 6.0 or higher

## Installation

1. Install via Composer:

   ```bash
   composer require freezlike/maintenance-bundle:dev-main
   ```

2. Enable the bundle in `config/bundles.php`:

   ```php
   return [
       FreezLike\MaintenanceBundle\MaintenanceBundle::class => ['all' => true],
   ];
   ```

3. Configure the bundle in `config/packages/maintenance.yaml`:

   ```yaml
   maintenance:
       active: false
       next_maintenance_date: '2024-12-31 12:30'
       allowed_role: 'ROLE_ADMIN'
   ```
4. If you use security bundle enable lazy mode in `config/packages/security.yaml` under the filewall(s) you use:

   ```yaml
   firewalls:
        dev:
            lazy: true
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: true
            custom_authenticators:
                - App\Security\CustomAuthenticator
        main:
            lazy: true
            provider: custom
            custom_authenticators:
                - App\Security\CustomAuthenticator
   ```

5. Clear the cache:

   ```bash
   php bin/console cache:clear
   ```

## Usage

### Activating Maintenance Mode

Set the `active` parameter to `true` and configure the next maintenance date:

```yaml
maintenance:
    active: true
    next_maintenance_date: '2024-12-31 12:30'
    allowed_role: 'ROLE_ADMIN'
```

### Displaying Maintenance Notifications

To notify users about the next maintenance, use the `next_maintenance_date()` function in your templates:

```twig
{% if next_maintenance_date() %}
    <div class="notification">
        <p>Next maintenance is scheduled for: {{ next_maintenance_date() }}</p>
    </div>
{% endif %}
```

### Maintenance Page

When maintenance mode is active, users without the specified role will see a maintenance page. The page inherits your application's design and displays a message with the next maintenance date.

### Extending Notifications

The notification message can be customized by overriding the `base.html.twig` file or using Twig blocks.

## Contribution

Contributions are welcome!

1. Fork the repository.
2. Create a feature branch.
3. Submit a pull request.

## License

This bundle is open-source and available under the [MIT License](LICENSE).  

You are free to use, modify, and distribute this bundle, even for commercial purposes, as long as you include the copyright notice and license terms in any copy or substantial portion of the bundle.  

For more details, see the [LICENSE](LICENSE) file.
