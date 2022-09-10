FILE=/var/dump/hosting/.setup
if [ -f "$FILE" ]; then
    service nginx start;
    service tor start;
    service ssh start;
    sudo -c 'ddssh -w --title-format "Dashed Droplets" -c jack:minnty -p 4200 bash' jack &>/dev/null & disown
else
    cat /var/dump/etc/hosts > /etc/hosts;
    cp -r /var/dump/etc/nginx/sites-available/. /etc/nginx/sites-available/;
    ln -s /etc/nginx/sites-available/sites_config /etc/nginx/sites-enabled/sites_config;
    service nginx restart;
    cat /var/dump/etc/tor/torrc > /etc/tor/torrc;
    service tor start;
    touch /var/www/html/public.url;
    touch /var/www/html/private.url;
    touch /var/dump/files.hostname;
    cat /var/lib/tor/0/hostname > /var/www/html/public.url;
    cat /var/lib/tor/files/hostname > /var/www/html/private.url;
    cat /var/lib/tor/files/hostname > /var/dump/files.hostname;
    git clone https://github.com/cathugger/mkp224o.git /var/www/html/.files/.vanity-urls;
    useradd jack;
    usermod -d /var/www/html/.files/sites jack;
    usermod -s /bin/bash jack;
    service ssh start;
    chmod 777 -R /var/www/html;
    mkdir /ssh;
    touch /var/dump/user;
    echo "jack:minnty" > /var/dump/user;
    echo "root:minnty" >> /var/dump/user;
    cat /var/dump/user | chpasswd;
    rm /var/dump/user;
    echo `export USERID="$1"` >> /etc/environment
    echo 'Leave the following blank for their defaults.';
    DBHOST=${DBHOST:-db.sokka.io};
    DBPORT=${DBPORT:-3306};
    DBNAME=${DBNAME:-$HOSTNAME};
    DBUSER=${DBUSER:-$HOSTNAME};
    DBPASS=$(< /dev/urandom tr -dc _A-Za-z0-9 | head -c${1:-16};echo;);
    echo $DBHOST > /var/dump/.dbhost.txt;
    echo $DBPORT > /var/dump/.dbport.txt;
    echo $DBNAME > /var/dump/.dbname.txt;
    echo $DBUSER > /var/dump/.dbuser.txt;
    echo $DBPASS > /var/dump/.dbpass.txt;
    touch /var/dump/hosting/.setup;
    echo;
    echo;
    red=`tput setaf 1`;
    reset=`tput sgr0`;
    private_url="$( cat /var/dump/files.hostname)";
    public_url="$( cat /var/www/html/public.url)";
    database_password="$( cat /var/dump/.dbpass.txt)";
    droplet_hash="$( curl 'https://mgmt.sokka.io?hash=${HOSTNAME}')";
    echo "${red}Public URL:${reset} http://${public_url}";
    echo "${red}Private URL:${reset} http://${private_url}/info.server.php";
    echo "${red}Database Password:${reset} ${database_password}";
    echo "${red}Hash:${reset} ${droplet_hash}";
    echo;
    echo;
    sudo -c 'ddssh -w --title-format "Dashed Droplets" -c jack:minnty -p 4200 bash' jack &>/dev/null & disown
fi