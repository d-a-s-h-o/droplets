FROM php:7.2-apache AS php1
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update -y && apt upgrade -y && apt-get install -y tor docker nano vim git software-properties-common build-essential zlib1g-dev libncurses5-dev libgdbm-dev libnss3-dev libssl-dev libreadline-dev libffi-dev libsqlite3-dev wget libbz2-dev openssh-server tasksel gcc libsodium-dev make mc autoconf shellinabox
RUN apt install curl &&  curl -fsSL https://get.docker.com -o get-docker.sh && sh get-docker.sh
RUN dockerd &
COPY etc /var/www/dump/etc/
COPY var/www/html /var/www/html
EXPOSE 80 7662 22 24 4200 81
FROM php1
RUN chmod +x /var/www/html/setup
RUN chmod +x /var/www/html/start
