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
    'instanceid' => '',
    'passwordsalt' => '',
    'secret' => '',
    'trusted_domains' =>
        array (
            0 => 'cloud.symbiolab.de',
        ),
    'datadirectory' => '/opt/cloud.symbiolab.de-data',
    'overwrite.cli.url' => 'https://cloud.symbiolab.de',
    'installed' => true,
    'memcache.local' => '\OC\Memcache\APCu',
    'memcache.locking' => '\OC\Memcache\Redis',
    'redis' => [
          'host' => 'redis',
          'port' => 6379,
          'password' => '',
      ],
    'filelocking.enabled' => 'true',
    'dbtype' => 'pgsql',
    'version' => '29.0.1.1',
    'overwriteprotocol' => 'https',
    'dbname' => 'nextcloud',
    'dbhost' => 'centraldb',
    'dbport' => '',
    'dbtableprefix' => 'oc_',
    'dbuser' => 'nextcloud',
    'dbpassword' => '',
    'logtimezone' => 'UTC',
    'theme' => '',
    'loglevel' => 2,
    'maintenance' => false,
);
