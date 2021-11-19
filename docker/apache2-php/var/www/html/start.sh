service apache2 start;
service tor start;
service ssh start;
shellinaboxd -b --disable-ssl -s /:AUTH:HOME:/bin/bash;