#!/bin/bash
printf "Creating possible missing Directories\n"
mkdir -p /usr/share/webapps/nextcloud/data
mkdir -p /usr/share/webapps/nextcloud/updater

chmod +x /usr/share/webapps/nextcloud/occ

printf "chmod/chown .htaccess\n"
if [ -f /usr/share/webapps/nextcloud/.htaccess ]
 then
  chmod -v 0644 /usr/share/webapps/nextcloud/.htaccess
  chown -v root:http /usr/share/webapps/nextcloud/.htaccess
fi
if [ -f /usr/share/webapps/nextcloud/data/.htaccess ]
 then
  chmod -v 0644 /usr/share/webapps/nextcloud/data/.htaccess
  chown -v root:http /usr/share/webapps/nextcloud/data/.htaccess
fi

locale-gen
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
