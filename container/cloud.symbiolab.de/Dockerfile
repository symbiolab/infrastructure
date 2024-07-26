FROM nextcloud
MAINTAINER Sebastian Selka

RUN pacman -Sy
RUN pacman --noconfirm -S vim

COPY conf/nextcloud.conf.php /etc/webapps/nextcloud/config/config.php
COPY .env /root/.env

RUN chown -R -v http:http /etc/webapps/nextcloud/config/config.php
CMD ["/bin/sh", "-c", "/root/start.sh"]

