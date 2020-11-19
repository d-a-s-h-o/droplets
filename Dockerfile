FROM php:7.2-apache AS php1
RUN apt-get update -y && apt upgrade -y && apt-get install -y docker tor nano git software-properties-common build-essential zlib1g-dev libncurses5-dev libgdbm-dev libnss3-dev libssl-dev libreadline-dev libffi-dev libsqlite3-dev wget libbz2-dev mariadb-server openssh-server tasksel gcc libsodium-dev make mc autoconf shellinabox
COPY etc /var/www/dump/etc/
COPY var/www/html /var/www/html
EXPOSE 80

FROM php1
RUN cat /var/www/dump/etc/hosts > /etc/hosts; \
cat /var/www/dump/etc/apache2/ports.conf > /etc/apache2/ports.conf; \
cp -r /var/www/dump/etc/apache2/sites-available/. /etc/apache2/sites-available/; \
a2dissite 000-default.conf; \
a2dissite default-ssl.conf; \
a2delsite 000-default.conf; \
a2delsite default-ssl.conf; \
a2ensite 1.conf; \
a2ensite files.conf; \
service apache2 reload; \
cat /var/www/dump/etc/tor/torrc > /etc/tor/torrc; \
service tor start; \
touch /var/www/html/onion.url; \
touch /var/www/dump/files.hostname; \
cat /var/lib/tor/1/hostname > /var/www/html/onion.url; \
cat /var/lib/tor/files/hostname > /var/www/dump/files.hostname; \
git clone https://github.com/cathugger/mkp224o.git /var/www/html/.files/.vanity-urls; \
sh /var/www/html/.files/.vanity-urls/autogen.sh; \
sh /var/www/html/.files/.vanity-urls/configure; \
make /var/www/html/.files/.vanity-urls/; \
chmod 777 /var/www/html; \
chmod 777 /var/www/html/.files; \
chmod 777 /var/www/html/.files/1; \
useradd jack; \
usermod -d /var/www/html/.files/1 jack;