<?php
$CONFIG = array (
    'apps_paths' =>
        array (
            0 =>
                array (
                    'path' => '/usr/share/webapps/nextcloud/apps',
                    'url' => '/apps',
                    'writable' => false,
                ),
            1 =>
                array (
                    'path' => '/var/www/nextcloud/apps',
                    'url' => '/wapps',
                    'writable' => true,
                ),
        ),
    'instanceid' => 'WHATEVER',
    'passwordsalt' => getenv('NEXTCLOUD_PASSWORDSALT'),
    'secret' => getenv('NEXTCLOUD_SECRET'),
    'trusted_domains' =>
        array (
            0 => 'anytech.team',
        ),
    'datadirectory' => '/opt/nextcloud-data',
    'overwrite.cli.url' => 'https://anytech.team',
    'installed' => true,
    'memcache.local' => '\OC\Memcache\APCu',
    'memcache.locking' => '\OC\Memcache\Redis',
    'redis' => [
          'host' => 'redis',
          'port' => 6379,
          'password' => getenv('REDIS_PASSWORD'),
      ],
    'filelocking.enabled' => 'true',
    'dbtype' => 'pgsql',
    'version' => '30.0.1.2',
    'overwriteprotocol' => 'https',
    'dbname' => 'nextcloud',
    'dbhost' => getenv('POSTGRES_HOST'),
    'dbport' => '',
    'dbtableprefix' => 'oc_',
    'dbuser' => getenv('POSTGRES_USER'),
    'dbpassword' => getenv('POSTGRES_PASSWORD'),
    'theme' => '',
    'logtimezone' => 'UTC',
    'loglevel' => 2,
    'log_query' => true,
    'logfile' => '/var/www/nextcloud/nextcloud.log',
    'syslog_tag' => 'ANYTECH_TEAM_CLOUD',
    'maintenance' => false,
);