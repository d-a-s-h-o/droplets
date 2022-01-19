FILE=/var/www/html/.setup
if [ -f "$FILE" ]; then
    service apache2 start;
    service tor start;
    service ssh start;
    sudo -c 'ddssh -w --title-format "Dashed Droplets" -c jack:minnty -p 4200 bash' jack &>/dev/null & disown
else
    cat /var/www/dump/etc/hosts > /etc/hosts;
    cat /var/www/dump/etc/apache2/ports.conf > /etc/apache2/ports.conf;
    cp -r /var/www/dump/etc/apache2/sites-available/. /etc/apache2/sites-available/;
    a2dissite 000-default.conf;
    a2dissite default-ssl.conf;
    a2delsite 000-default.conf;
    a2delsite default-ssl.conf;
    a2ensite 0.conf;
    a2ensite files.conf;
    service apache2 reload;
    cat /var/www/dump/etc/tor/torrc > /etc/tor/torrc;
    service tor start;
    touch /var/www/html/public.url;
    touch /var/www/html/private.url;
    touch /var/www/dump/files.hostname;
    cat /var/lib/tor/0/hostname > /var/www/html/public.url;
    cat /var/lib/tor/files/hostname > /var/www/html/private.url;
    cat /var/lib/tor/files/hostname > /var/www/dump/files.hostname;
    git clone https://github.com/cathugger/mkp224o.git /var/www/html/.files/.vanity-urls;
    useradd jack;
    usermod -d /var/www/html/.files/sites jack;
    service apache2 reload;
    service ssh start;
    chmod 777 -R /var/www/html;
    mkdir /ssh;
    touch /var/www/dump/user;
    echo "jack:minnty" > /var/www/dump/user;
    echo "root:minnty" >> /var/www/dump/user;
    cat /var/www/dump/user | chpasswd;
    rm /var/www/dump/user;
    echo `export USERID="$1"` >> /etc/environment
    echo 'Leave the following blank for their defaults.';
    DBHOST=${DBHOST:-db.onionz.dev};
    DBPORT=${DBPORT:-3306};
    DBNAME=${DBNAME:-$HOSTNAME};
    DBUSER=${DBUSER:-$HOSTNAME};
    DBPASS=$(< /dev/urandom tr -dc _A-Za-z0-9 | head -c${1:-16};echo;);
    echo $DBHOST > /var/www/.dbhost.txt;
    echo $DBPORT > /var/www/.dbport.txt;
    echo $DBNAME > /var/www/.dbname.txt;
    echo $DBUSER > /var/www/.dbuser.txt;
    echo $DBPASS > /var/www/.dbpass.txt;
    touch /var/www/html/.setup;
    echo;
    echo;
    red=`tput setaf 1`;
    reset=`tput sgr0`;
    private_url="$( cat /var/www/dump/files.hostname)";
    public_url="$( cat /var/www/html/public.url)";
    database_password="$( cat /var/www/.dbpass.txt)";
    echo "${red}Public URL:${reset} http://${public_url}";
    echo "${red}Private URL:${reset} http://${private_url}/info.server.php";
    echo "${red}Database Password:${reset} ${database_password}";
    echo;
    echo;
    sudo -c 'ddssh -w --title-format "Dashed Droplets" -c jack:minnty -p 4200 bash' jack &>/dev/null & disown
fi