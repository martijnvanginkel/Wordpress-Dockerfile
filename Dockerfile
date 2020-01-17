FROM debian:buster

RUN apt-get update && apt-get upgrade
RUN apt-get -y install nginx
RUN apt-get -y install mariadb-server
RUN apt-get -y install php7.3 php-mysql php-fpm php-cli php-mbstring php-curl php-gd php-intl php-soap php-xml php-xmlrpc php-zip

RUN apt-get -y install wget
RUN apt-get -y install vim

COPY ./srcs/start.sh /root

# mysql
RUN service mysql start; \ 
    mysql -u root; \
    echo "CREATE DATABASE wordpress" | mysql -u root; \
    echo "GRANT ALL PRIVILEGES ON *.* TO 'mvan-gin'@'localhost' IDENTIFIED BY 'asdf';" | mysql -u root; \
    echo "FLUSH PRIVILEGES" | mysql -u root;

WORKDIR /var/cert
RUN openssl genrsa -out localhost.key 2048
RUN openssl req -new -x509 -key localhost.key -out localhost.cert -days 3650 -subj /CN=localhost

RUN mkdir -p /var/www/localhost
RUN chmod -R 755 /var/www/localhost

COPY ./srcs/localhost /etc/nginx/sites-available
RUN ln -s /etc/nginx/sites-available/localhost /etc/nginx/sites-enabled/

WORKDIR /etc/nginx/sites-enabled/

RUN rm default

WORKDIR /var/www/localhost/wordpress

# phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/4.9.0.1/phpMyAdmin-4.9.0.1-all-languages.tar.gz &&\
    tar zxvf phpMyAdmin-4.9.0.1-all-languages.tar.gz &&\
    rm phpMyAdmin-4.9.0.1-all-languages.tar.gz &&\
    mv phpMyAdmin-4.9.0.1-all-languages phpmyadmin &&\
    chmod -R 755 phpmyadmin

COPY ./srcs/config.inc.php ./phpmyadmin

# wordpress
RUN wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar &&\
    chmod +x wp-cli.phar &&\
    mv wp-cli.phar /usr/local/bin/wp &&\
    mkdir wordpress &&\
    service mysql restart &&\
    wp core download --allow-root &&\
    wp config create --dbhost=localhost --dbname=wordpress --dbuser=mvan-gin --dbpass=asdf --allow-root &&\
    chmod 644 wp-config.php &&\
    wp core install --url=localhost --title="wordpress website" --admin_name=mvan-gin --admin_password=asdf --admin_email=mvan-gin@codam.student.nl --allow-root &&\
    wp theme install https://downloads.wordpress.org/theme/shapely.1.2.8.zip --allow-root && \
    wp theme activate shapely --allow-root

RUN rm /etc/php/7.3/fpm/php.ini
RUN rm /var/www/localhost/wordpress/wp-config.php

COPY ./srcs/php.ini /etc/php/7.3/fpm/
COPY ./srcs/wp-config.php /var/www/localhost/wordpress/

RUN chown -R www-data /var/www/localhost/wordpress/wp-content/uploads &&\
    chmod 777 /var/www/localhost/wordpress/wp-content/upgrade &&\
    chmod 777 /var/www/localhost/wordpress/wp-content/plugins &&\
    chmod 777 /var/www/localhost/wordpress/wp-content/themes &&\
    chmod 777 /var/www/localhost/wordpress


EXPOSE 80 443 110

CMD bash /root/start.sh
