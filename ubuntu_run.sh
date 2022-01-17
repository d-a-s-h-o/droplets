FILE=/var/dump/var/.setup
if [ -f "$FILE" ]; then
    service tor start
    service ssh start
    nohup ddssh -w --title-format "Dashed Droplets" -c jack:minnty -p 4200 bash &
else
    cat /var/dump/etc/tor/torrc >/etc/tor/torrc
    service tor start
    touch /var/dump/var/ssh.url
    cat /var/lib/tor/ssh/hostname >/var/dump/var/ssh.url
    useradd jack
    usermod -d /home/jack jack
    service ssh start
    mkdir /ssh
    touch /home/jack/user
    echo "jack:minnty" >/home/jack/user
    echo "root:minnty" >>/home/jack/user
    cat /home/jack/user | chpasswd
    rm /home/jack/user
    echo $(export USERID="$1") >>/etc/environment
    touch /var/dump/var/.setup
    echo;
    echo;
    cat /var/dump/var/ssh.url
    echo;
    echo;
    nohup ddssh -w --title-format "Dashed Droplets" -c jack:minnty -p 4200 bash &
fi