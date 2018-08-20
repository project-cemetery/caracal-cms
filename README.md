[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/igorkamyshev/caracal-cms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/igorkamyshev/caracal-cms/?branch=master)
[![Build Status](https://travis-ci.org/igorkamyshev/caracal-cms.svg?branch=master)](https://travis-ci.org/igorkamyshev/caracal-cms)

# Caracal CMS

Oversimplified CMS, provide API and admin-interface

## Development

+ `composer install`
+ `php bin/console doctrine:database:create`
+ `php bin/console doctrine:migrations:migrate`
+ `yarn install`
+ `yarn watch`
+ `php bin/console server:start`

### Check code

#### Backend

+ `php bin/phpunit` for test
+ `php vendor/bin/ecs check {src,tests} --fix` for fix code-style
+ `php vendor/bin/psalm` for static analysis

+ `composer code` for run all checks

#### Frontend

+ `yarn lint --fix` for fix code-style
+ `yarn size` for check bundle size

+ `yarn code` for run all checks