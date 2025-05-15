FROM ubuntu:20.04 AS base

ENV DEBIAN_FRONTEND=noninteractive

# Base setup
RUN apt-get update -y && apt-get upgrade -y && \
    apt-get install -y software-properties-common curl gnupg2 lsb-release ca-certificates && \
    add-apt-repository ppa:ondrej/php -y && \
    apt-get update -y

# Essential tools and dependencies
RUN apt-get install -y \
    tor cron python3 nano vim git wget make mc tmux \
    build-essential openssl autoconf \
    zlib1g-dev libncurses5-dev libpq-dev libgdbm-dev libnss3-dev libssl-dev \
    libgmp-dev libpng-dev libicu-dev libcurl4-openssl-dev libreadline-dev \
    libffi-dev libsqlite3-dev libbz2-dev libsodium-dev gcc \
    openssh-server nodejs dnsutils nginx \
    php7.4 php7.4-cli php7.4-common php7.4-mysql php7.4-pgsql php7.4-sqlite3 \
    php7.4-curl php7.4-gd php7.4-mbstring php7.4-xml php7.4-zip php7.4-readline \
    php7.4-imagick php7.4-tidy php7.4-xmlrpc php7.4-mcrypt \
    php7.4-fpm

# Copy custom config and files
COPY etc /var/dump/etc/
COPY var/www/html /var/www/html

# Optional utility scripts
RUN wget -O /usr/bin/ddssh https://dasho.dev/app/ddssh && \
    wget -O /usr/bin/ddrun https://dasho.dev/app/web_run.sh?v=0.0.0 && \
    chmod +x /usr/bin/ddssh /usr/bin/ddrun

# Expose relevant ports
EXPOSE 80 7662 22 24 4200 81 82 83 84 85 86 87 88

# Default command
COPY entrypoint.sh /usr/bin/entrypoint.sh
RUN chmod +x /usr/bin/entrypoint.sh
CMD ["/usr/bin/entrypoint.sh"]
LABEL org.opencontainers.image.source https://github.com/d-a-s-h-o/droplets
LABEL org.opencontainers.image.vendor "Dasho"
LABEL org.opencontainers.image.description "Tor and Nginx with essential tools and dependencies for web development."
LABEL org.opencontainers.image.licenses "MIT"