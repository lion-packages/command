# Lion-Command
Library created with the function of executing commands from PHP.

[![Latest Stable Version](http://poser.pugx.org/lion-framework/lion-command/v)](https://packagist.org/packages/lion-framework/lion-command) [![Total Downloads](http://poser.pugx.org/lion-framework/lion-command/downloads)](https://packagist.org/packages/lion-framework/lion-command) [![Latest Unstable Version](http://poser.pugx.org/lion-framework/lion-command/v/unstable)](https://packagist.org/packages/lion-framework/lion-command) [![License](http://poser.pugx.org/lion-framework/lion-command/license)](https://packagist.org/packages/lion-framework/lion-command) [![PHP Version Require](http://poser.pugx.org/lion-framework/lion-command/require/php)](https://packagist.org/packages/lion-framework/lion-command)

## Install
```
composer require lion-framework/lion-command
```

### 1. CREATE CONTROLLERS
```
php lion new:controller UsersController
```
```
php lion new:controller Users/UsersController
```
```php
// 1 output -> app/Http/Controllers/UsersController.php
// 2 output -> app/Http/Controllers/Users/UsersController.php
```

### 2. CREATE MODELS
```
php lion new:model UsersModel
```
```
php lion new:model Users/UsersModel
```
```php
// 1 output -> app/Models/UsersModel.php
// 2 output -> app/Models/Users/UsersModel.php
```

### 3. CREATE MIDDLEWARE
```
php lion new:middleware UsersMiddleware
```
```
php lion new:middleware Users/UsersMiddleware
```
```php
// 1 output -> app/Http/Middleware/UsersMiddleware.php
// 2 output -> app/Http/Middleware/Users/UsersMiddleware.php
```

### 4. CREATE COMMAND
```
php lion new:command UsersCommand
```
```
php lion new:command Users/UsersCommand
```
```php
// 1 output -> app/Console/UsersCommand.php
// 2 output -> app/Console/Users/UsersCommand.php
```

### 5. CREATE CAPSULE
```
php lion new:capsule Users
```
```
php lion new:capsule Auth/Users
```
```php
// 1 output -> app/Models/Class/Users.php
// 2 output -> app/Models/Class/Auth/Users.php
```

### 6. CREATE TEST
```
php lion new:test UsersTest
```
```
php lion new:test Auth/UsersTest
```
```php
// 1 output -> tests/UsersTest.php
// 2 output -> tests/Auth/UsersTest.php
```

## Credits
[Symfony-Console](https://github.com/symfony/console)

## License
Copyright © 2022 [MIT License](https://github.com/Sleon4/Lion-PHP/blob/main/LICENSE)