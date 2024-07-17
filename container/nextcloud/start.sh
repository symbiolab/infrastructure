#!/bin/sh

# Ersetze Passwörter in der Konfigurationsdatei
sed -i "s/'passwordsalt' => '',/'passwordsalt' => '$NEXTCLOUD_PASSWORDSALT',/" /etc/webapps/nextcloud/config/config.php
sed -i "s/'secret' => '',/'secret' => '$NEXTCLOUD_SECRET',/" /etc/webapps/nextcloud/config/config.php
sed -i "s/'password' => '',/'password' => '$REDIS_PASSWORD',/" /etc/webapps/nextcloud/config/config.php
sed -i "s/'dbpassword' => '',/'dbpassword' => '$POSTGRES_PASSWORD',/" /etc/webapps/nextcloud/config/config.php
sed -i "s/'dbhost' => '',/'dbhost' => '$POSTGRES_HOST',/" /etc/webapps/nextcloud/config/config.php


/usr/bin/php-fpm-legacy -y /etc/php-legacy/php-fpm.conf
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf