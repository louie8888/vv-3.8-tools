

#!/bin/bash
for d in $*
do 
mkdir  -p /home/wwwroot/www.$d
#cp -r /home/www/vvutf8/*  /home/wwwroot/www.$d/
cp -r /home/www/vv/*  /home/wwwroot/www.$d/
chmod -R 777 /home/wwwroot/www.$d/*
cp -rf /usr/local/nginx/conf/www.default.com.conf  /usr/local/nginx/conf/vhost/www.$d.conf
sed -i s/domain/$d/g  /usr/local/nginx/conf/vhost/www.$d.conf
done
service nginx restart

