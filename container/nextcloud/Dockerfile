FROM archlinux:latest
MAINTAINER Sebastian Selka

RUN pacman --noconfirm -Syu
RUN pacman --noconfirm -S \
        supervisor \
        nginx-mainline \
        wget \
        php-legacy-fpm \
        php-legacy-pgsql \
        php-legacy-apcu \
        php-legacy-redis \
        php-legacy-gd \
        nextcloud \
        fcron

EXPOSE 80 80

RUN cd /usr/share/webapps/nextcloud/apps/ && \
    wget -O calendar.tar.gz https://github.com/nextcloud-releases/calendar/releases/download/v4.7.11/calendar-v4.7.11.tar.gz && \
    tar xvfz calendar.tar.gz && \
    rm calendar.tar.gz

RUN cd /usr/share/webapps/nextcloud/apps/ && \
    wget -O contacts.tar.gz https://github.com/nextcloud-releases/contacts/releases/download/v6.0.0/contacts-v6.0.0.tar.gz && \
    tar xvfz contacts.tar.gz && \
    rm contacts.tar.gz

RUN cd /usr/share/webapps/nextcloud/apps/ && \
    wget -O deck.tar.gz https://github.com/nextcloud-releases/deck/releases/download/v1.13.1/deck-v1.13.1.tar.gz && \
    tar xvfz deck.tar.gz && \
    rm deck.tar.gz

RUN cd /usr/share/webapps/nextcloud/apps/ && \
    wget -O richdocuments.tar.gz https://github.com/nextcloud-releases/richdocuments/releases/download/v8.4.3/richdocuments-v8.4.3.tar.gz && \
    tar xvfz richdocuments.tar.gz && \
    rm richdocuments.tar.gz

RUN cd /usr/share/webapps/nextcloud/apps/ && \
    wget -O polls.tar.gz https://github.com/nextcloud/polls/releases/download/v7.1.4/polls-7.1.4.tar.gz && \
    tar xvfz polls.tar.gz && \
    rm polls.tar.gz

RUN mkdir -p /var/www/nextcloud/apps  && \
    mkdir -p /usr/share/webapps/nextcloud/data  && \
    mkdir -p /usr/share/webapps/nextcloud/updater  && \
    mkdir -p /opt/owncloud-data  && \
    usermod -u 1000 http

RUN chown -v    root:root /usr/share/webapps/nextcloud && \
    chown -R -v http:http /var/www/nextcloud/apps && \
    mkdir /var/www/nextcloud/apps/calendar && \
    chown -R -v http:http /var/www/nextcloud/apps/calendar && \
    mkdir http:http /var/www/nextcloud/apps/contacts && \
    chown -R -v http:http /var/www/nextcloud/apps/contacts && \
    mkdir /var/www/nextcloud/apps/deck && \
    chown -R -v http:http /var/www/nextcloud/apps/deck && \
    mkdir /var/www/nextcloud/apps/richdocuments && \
    chown -R -v http:http /var/www/nextcloud/apps/richdocuments && \
    chown -R -v http:http /usr/share/webapps/nextcloud/config/ && \
    chown -R -v http:http /usr/share/webapps/nextcloud/data/ && \
    chown -R -v http:http /usr/share/webapps/nextcloud/themes/ && \
    chown -R -v http:http /usr/share/webapps/nextcloud/updater/ && \
    chown -R -v http:http /usr/share/webapps/nextcloud/apps/ && \
    chown -R -v http:http /etc/webapps/nextcloud/

RUN chown 774    /usr/share/webapps/nextcloud && \
    chmod -R 774 /var/www/nextcloud/apps && \
    chmod -R 774 /usr/share/webapps/nextcloud/config && \
    chmod -R 774 /usr/share/webapps/nextcloud/data && \
    chmod -R 774 /usr/share/webapps/nextcloud/themes && \
    chmod -R 774 /usr/share/webapps/nextcloud/updater && \
    chmod -R 774 /usr/share/webapps/nextcloud/apps && \
    chmod -R 774 /etc/webapps/nextcloud && \
    chmod +x /usr/share/webapps/nextcloud/occ

COPY start.sh /root/start.sh
RUN chown -R -v http:http /etc/webapps/nextcloud/config/config.php && \
    chmod +x /root/start.sh

COPY conf/nginx.conf /etc/nginx/nginx.conf
COPY conf/php.ini /etc/php-legacy/php.ini
COPY conf/php-fpm.conf /etc/php-legacy/php-fpm.conf
COPY conf/www.conf /etc/php-legacy/php-fpm.d/www.conf
COPY conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf