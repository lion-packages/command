# Lion-Command
## Library created with the function of executing commands from PHP.

[![Latest Stable Version](http://poser.pugx.org/lion-framework/lion-command/v)](https://packagist.org/packages/lion-framework/lion-command) [![Total Downloads](http://poser.pugx.org/lion-framework/lion-command/downloads)](https://packagist.org/packages/lion-framework/lion-command) [![License](http://poser.pugx.org/lion-framework/lion-command/license)](https://packagist.org/packages/lion-framework/lion-command) [![PHP Version Require](http://poser.pugx.org/lion-framework/lion-command/require/php)](https://packagist.org/packages/lion-framework/lion-command)

## Install
```
composer require lion-framework/lion-command
```

## Usage
```php
// lion file

require_once("vendor/autoload.php");

LionCommand\SystemCommand::init([
    LionCommand\Command\ControllerCommand::class,
    LionCommand\Command\ModelCommand::class,
    LionCommand\Command\MiddlewareCommand::class,
    LionCommand\Command\CommandsCommand::class,
    LionCommand\Command\CapsuleCommand::class,
    LionCommand\Command\TestCommand::class,
    LionCommand\Command\ServerCommand::class,
    LionCommand\Command\RunTestCommand::class,
    LionCommand\Command\RulesCommand::class
]);
```

## LIST COMMAND
```shell
php lion serve
php lion new:controller name_controller
php lion new:model name_model
php lion new:middleware name_middleware
php lion new:command name_command
php lion new:capsule name_capsule
php lion new:test name_test
php lion test
php lion new:rule name_rule
```

## OPTIONAL
```shell
php lion serve --port=4041
```

To create custom commands the following must be executed, For more information on creating custom commands read on [Symfony-Console](https://symfony.com/doc/current/components/console.html).
```shell
php lion new:command name_command
```

## Credits
[Symfony-Console](https://github.com/symfony/console)

## License
Copyright © 2022 [MIT License](https://github.com/Sleon4/Lion-PHP/blob/main/LICENSE)