FROM ubuntu:focal AS ubuntu1
RUN apt update -y && apt upgrade -y
RUN apt install -y tor cron python3 nano vim git
ARG DEBIAN_FRONTEND=noninteractive
RUN apt install -y software-properties-common build-essential
RUN apt install -y curl wget openssh-server nodejs tasksel gcc
RUN apt install -y make mc autoconf dnsutils tmux openssl
COPY var/dump /var/dump/
RUN wget -O /usr/bin/ddssh https://cdn.onionz.dev/app/ddssh
EXPOSE 22 4200

FROM ubuntu1
RUN wget -O /usr/bin/ddrun https://cdn.onionz.dev/app/ubutnu_run.sh?v=1
RUN chmod +x /usr/bin/ddrun
RUN chmod +x /usr/bin/ddssh