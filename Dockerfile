# docker/build/php/Dockerfile

FROM php:7.2-apache

# Update server, install vim and mysql client for debugging
RUN apt-get update && apt-get install -y vim && apt-get install -y mysql-client

# Install required libraries
RUN apt-get install -y zlib1g-dev
RUN apt-get -y install librabbitmq-dev

# Install required php extensions
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install sockets
RUN docker-php-ext-install pdo_mysql
RUN echo "extension=pdo_mysql" | tee -a /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini-production
RUN printf "\n" | pecl install amqp
RUN docker-php-ext-enable amqp
RUN echo "extension=amqp" | tee -a /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini-production

#Copy Sf project
COPY --chown=www-data . /var/www/html/

#Configure web server
RUN mv conf/000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN mv conf/.htaccess /var/www/html/public/.htaccess
RUN a2enmod rewrite

# Install Application dependencies
RUN php composer.phar install

COPY conf/entry-point.sh /entry-point.sh

#ENTRYPOINT ["/entry-point.sh"]

CMD ["/entry-point.sh"]