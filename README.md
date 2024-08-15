# Symbiolab Infrastructure

Here, we share our basic infrastructure setups publicly.

Feel free to use it for your small Tech business (SME), give feedback or provide Pull Requests if you see room for improvements. 

We're going to extend the setup step by step.

## Howto setup (on Debian 12)

1. Get some machine to run your [Nextcloud](https://nextcloud.com).
2. Create secure and long passwords (e.g., use `pwgen -n 50`) for your environment variables and put them to an `.env` file to provide them further (do not change the last two lines): 
```
REDIS_PASSWORD=<PASTE HERE>
POSTGRES_PASSWORD=<PASTE HERE>
NEXTCLOUD_PASSWORDSALT=<PASTE HERE>
NEXTCLOUD_SECRET=<PASTE HERE>
NEXTCLOUD_ADMIN_PASSWORD=<PASTE HERE>

POSTGRES_USER=nextcloud
POSTGRES_HOST=centraldb
```
3. Copy everything from this repo your machine: `scp -r con* root@anytech.team:/root/docker && scp -r docker-compose.yml root@anytech.team:/root/docker && scp .env root@anytech.team:/root/docker/.env`
4. Run that complete block of code in order to set it up completely and reboot the system afterwards:
```
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
sleep 2
docker-compose exec -u 1000 cloudanytechteam bash -c "sed -i \"s/'installed' => true,/'installed' => false,/g\" /etc/webapps/nextcloud/config/config.php && php-legacy /usr/share/webapps/nextcloud/occ maintenance:install --database pgsql --database-name nextcloud --database-host $POSTGRES_HOST --database-port 5432 --database-user nextcloud --database-pass $POSTGRES_PASSWORD --admin-user admin --admin-pass $NEXTCLOUD_ADMIN_PASSWORD --data-dir /opt/nextcloud-data && php-legacy /usr/share/webapps/nextcloud/occ app:enable richdocuments calendar contacts deck polls"
docker-compose down 
docker-compose rm -f cloudanytechteam
reboot
```
5. Afterwards, login to your machine again and start the docker environment: `cd /root/docker && docker-compose up -d`
6. You're done.

## How to get collabora working?
1. Log in to your nextcloud (`admin` with your `NEXTCLOUD_ADMIN_PASSWORD`)
2. Click on your admin symbol on the top right, when you're logged in
3. Then click "Administration Settings" and under "Administration" you click "Office"
4. "Use your own server" by adding your domain, e.g., `https://office.anytech.team`

## Noteworthy

[Nextcloud](https://nextcloud.com) stores all data saved to the it locally on a storage device of your aforementioned machine. As this might be a virtual or shared medium, you may consider using encrypted data containers. E.g., [dm-crypt](https://gitlab.com/cryptsetup/cryptsetup/-/wikis/DMCrypt)