# Configure

Using Configure to set and manage default parameters in src/Controller/AppController.php

```php
Configure::write('Content', [
    'defaultUsersTable' => 'Users',
    'defaultRolesTable' => 'Roles',
    'defaultSiteId' => 1
]);
```