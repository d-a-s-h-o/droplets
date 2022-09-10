FROM ubuntu:focal AS base
ARG DEBIAN_FRONTEND=noninteractive
RUN apt update -y && apt upgrade -y
RUN apt install -y tor cron python3 nano vim git wget make mc tmux
RUN apt install -y software-properties-common build-essential openssl autoconf
RUN apt install -y zlib1g-dev libncurses5-dev libpq-dev libgdbm-dev libonig-dev libnss3-dev libssl-dev curl libgmp-dev libpng-dev libicu-dev libcurl4-openssl-dev libreadline-dev libffi-dev libsqlite3-dev libbz2-dev libsodium-dev gcc
RUN apt install -y openssh-server nodejs dnsutils

FROM base as install
RUN apt install nginx
RUN apt install php-fpm php-mcrypt php-cli php-mysql php-gd php-imagick php-recode php-tidy php-xmlrpc
RUN docker-php-ext-install curl ftp fileinfo gd mbstring exif mysqli pdo pdo_mysql pdo_pgsql pdo_sqlite 
COPY etc /var/dump/etc/
COPY var/www/html /var/www/html
RUN wget -O /usr/bin/ddssh https://cdn.onionz.dev/app/ddssh
EXPOSE 80 7662 22 24 4200 81 82 83 84 85 86 87 88

FROM install
RUN wget -O /usr/bin/ddrun https://cdn.onionz.dev/app/web_run.sh?v=2.0.0
RUN chmod +x /usr/bin/ddrun
RUN chmod +x /usr/bin/ddssh