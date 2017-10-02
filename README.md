Caracal CMS
===========

Легая и простая система управления контентом

---

## Установка
```
git pull
composer install
php bin/console doctrine:migrations:migrate
php bin/console cache:clear --env=prod --no-debug --no-warmup
php bin/console assetic:dump --env=prod --no-debug
```

### Параметры:
+ `app.current_theme = astral | editorial | massively | material-paralax`
+ `app.admin_version = lite | standart`

---

## Требования к серверу
+ PHP 7.0 или выше
+ MySQL