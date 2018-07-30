[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/igorkamyshev/caracal-cms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/igorkamyshev/caracal-cms/?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/d0a13d5d7113479681ae4479e1d1e559)](https://www.codacy.com/project/igorkamyshev/caracal-cms/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=igorkamyshev/caracal-cms&amp;utm_campaign=Badge_Grade_Dashboard)
[![Build Status](https://travis-ci.org/igorkamyshev/caracal-cms.svg?branch=master)](https://travis-ci.org/igorkamyshev/caracal-cms)

# Caracal CMS

Oversimplified CMS, provide API and admin-interface

## Development

+ `php bin/console doctrine:database:create`
+ `php bin/console server:start`

### Check code
+ `php bin/phpunit` for test
+ `php vendor/bin/ecs check src --fix` for fix code-style
