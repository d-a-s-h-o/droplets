FROM php:7.2-apache
RUN apt-get update -y && apt upgrade -y && apt-get install -y docker tor nano git software-properties-common build-essential zlib1g-dev libncurses5-dev libgdbm-dev libnss3-dev libssl-dev libreadline-dev libffi-dev libsqlite3-dev wget libbz2-dev mariadb-server openssh-server tasksel gcc libsodium-dev make mc autoconf shellinabox
COPY etc /var/www/dump/etc/
COPY var/www/html /var/www/html
EXPOSE 80