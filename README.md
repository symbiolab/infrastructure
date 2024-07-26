# Symbiolab Infrastructure

Here, we share our basic infrastructure setups publicly.

Feel free to use it for your small Tech business, give feedback or Pull Requests.




## Howto setup

1. get some machine
2. install `docker` and `docker-compose`
3. copy everything to your machine: `scp -r con* root@anytech.team:/root/docker && scp -r docker-compose.yml root@anytech.team:/root/docker && scp .env root@anytech.team:/root/docker/.env`
4. build containers `docker-compose build`
5. restrict access `touch /root/ssl/acme.json && chmod 600 /root/ssl/acme.json` on your machine
6. Set owner to the data directory: `chown 1000:1000 /root/docker/data/anytech.team-data -R && chmod 770 -R /root/docker/data/anytech.team-data`
7. Start the setup & log into the running conmtainer, and run the install routine: `php-legacy /usr/share/webapps/nextcloud/occ maintenance:install --database pgsql --database-name nextcloud --database-host $POSTGRES_HOST --database-port 5432 --database-user nextcloud --database-pass $POSTGRES_PASSWORD --admin-user admin --admin-pass $NEXTCLOUD_ADMIN_PASSWORD --data-dir /opt/nextcloud-data`
8. Toggling nextcloud config (`installed=true`) and rebuild containers, start up


### How to get Docker running on Debian12
apt update
apt upgrade -y
apt install apt-transport-https ca-certificates curl gnupg lsb-release -y
curl -fsSL https://download.docker.com/linux/debian/gpg | gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
apt update
apt install docker-ce docker-ce-cli containerd.io -y
apt install docker-compose -y
systemctl start docker
systemctl enable docker
usermod -aG docker $USER
mkdir /root/ssl && touch /root/ssl/acme.json && chmod 600 /root/ssl/acme.json
mkdir -p /root/docker/data/anytech.team-data
chown 1000:1000 /root/docker/data/anytech.team-data -R && chmod 770 -R /root/docker/data/anytech.team-data
cd /root/docker
docker-compose build
docker-compose up -d
source .env
docker-compose exec -u 1000 cloudsymbiolab bash -c "php-legacy /usr/share/webapps/nextcloud/occ maintenance:install --database pgsql --database-name milleventures --database-host $POSTGRES_HOST --database-port 5432 --database-user nextcloud --database-pass $POSTGRES_PASSWORD --admin-user admin --admin-pass $NEXTCLOUD_ADMIN_PASSWORD --data-dir /opt/nextcloud-data"

