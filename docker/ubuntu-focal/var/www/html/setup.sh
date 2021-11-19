useradd jack;
touch /home/jack;
usermod -d /home/jack jack;
service ssh start;
chmod 777 -R /home/jack;
shellinaboxd -b --disable-ssl;
touch /var/www/dump/user;
echo "jack:minnty" > /var/www/dump/user;
echo "root:minnty" >> /var/www/dump/user;
cat /var/www/dump/user | chpasswd;
rm /var/www/dump/user;
echo `export USERID="$1"` >> /etc/environment
touch .setup;