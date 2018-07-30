[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/igorkamyshev/caracal-cms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/igorkamyshev/caracal-cms/?branch=master)
[![Build Status](https://travis-ci.org/igorkamyshev/caracal-cms.svg?branch=master)](https://travis-ci.org/igorkamyshev/caracal-cms)

# Caracal CMS

Oversimplified CMS, provide API and admin-interface

## Development

+ `php bin/console doctrine:database:create`
+ `php bin/console server:start`

### Check code
+ `php bin/phpunit` for test
+ `php vendor/bin/ecs check src --fix` for fix code-style
