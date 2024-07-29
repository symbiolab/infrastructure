#!/bin/sh

/usr/bin/php-fpm-legacy -y /etc/php-legacy/php-fpm.conf
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf