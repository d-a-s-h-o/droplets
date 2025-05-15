FROM ubuntu:focal AS base
ARG DEBIAN_FRONTEND=noninteractive
RUN apt update -y && apt upgrade -y
RUN apt install -y tor cron python3 nano vim git wget make mc tmux
RUN apt install -y software-properties-common build-essential
RUN apt install -y curl wget openssh-server nodejs tasksel gcc
RUN apt install -y make mc autoconf dnsutils tmux openssl
COPY var/dump /var/dump/
RUN wget -O /usr/bin/ddssh https://dasho.dev/app/ddssh
EXPOSE 22 4200

FROM base as install
RUN wget -O /usr/bin/ddrun https://dasho.dev/app/ubuntu_run.sh?v=1.0.1
RUN chmod +x /usr/bin/ddrun
RUN chmod +x /usr/bin/ddssh
CMD ["sleep", "infinity"]
LABEL org.opencontainers.image.source https://github.com/d-a-s-h-o/droplets
LABEL org.opencontainers.image.vendor "Dasho"
LABEL org.opencontainers.image.description "Ubuntu 20.04 with essential tools and dependencies for development."
LABEL org.opencontainers.image.licenses "MIT"
