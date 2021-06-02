FROM php:7.4-apache AS php1
RUN docker-php-ext-install curl ftp fileinfo gd gettext gmp intl imap ldap mbstring exif mysqli odbc pdo pdo_firebird pdo_mysql pdo_pgsql pdo_sqlite sockets sodium sqlite3 
RUN apt-get update -y && apt upgrade -y && apt-get install -y tor docker.io python3 nano vim git software-properties-common build-essential zlib1g-dev libncurses5-dev libgdbm-dev libnss3-dev libssl-dev libreadline-dev libffi-dev libsqlite3-dev wget libbz2-dev openssh-server nodejs tasksel gcc libsodium-dev make mc autoconf shellinabox
COPY etc /var/www/dump/etc/
COPY var/www/html /var/www/html
EXPOSE 80 7662 22 24 4200 81 82 83 84 85 86 87 88

FROM php1
RUN chmod +x /var/www/html/setup
RUN chmod +x /var/www/html/start