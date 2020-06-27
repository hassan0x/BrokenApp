#!/bin/bash

cp -r WebAppPentest /var/www/html/

apt-get install -y apache2 php libapache2-mod-php php-gd mariadb-server php-mysql php-xml php-curl php-mbstring

a2enmod rewrite
a2enmod auth_digest

cat << EOT >> /etc/apache2/apache2.conf

<Directory "/var/www/html/WebAppPentest/0-Protected">
  AllowOverride All
  Options Indexes FollowSymLinks
  Order allow,deny
  Allow from all
</Directory>

<Directory "/var/www/html/WebAppPentest/1-BasicAuth">
  AllowOverride All
  Options Indexes FollowSymLinks
  Order allow,deny
  Allow from all
</Directory>

<Directory "/var/www/html/WebAppPentest/2-DigestAuth">
  AllowOverride All
  Options Indexes FollowSymLinks
  Order allow,deny
  Allow from all
</Directory>

EOT

mysql -u root -p mysql << eof
update user set authentication_string=PASSWORD("WebAppPentest") where user="root";
update user set plugin="mysql_native_password" where user="root";
flush privileges;
eof

sed -i '/error_reporting =/c\error_reporting = E_ALL' /etc/php/*/apache2/php.ini
sed -i '/display_errors =/c\display_errors = On' /etc/php/*/apache2/php.ini
sed -i '/allow_url_fopen =/c\allow_url_fopen = On' /etc/php/*/apache2/php.ini
sed -i '/allow_url_include =/c\allow_url_include = On' /etc/php/*/apache2/php.ini

chmod -R 755 /var/www/html/WebAppPentest
chmod 777 /var/www/html/WebAppPentest/4-CSRF
chmod 777 /var/www/html/WebAppPentest/8-FileUpload/uploads
chmod 777 /var/log/apache2/access.log

service mysql restart
service apache2 restart

php Setup.php
