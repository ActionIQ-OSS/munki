FROM php:7-apache

RUN apt-get update && \
    apt-get install --no-install-recommends -y libldap2-dev \
    libcurl4-openssl-dev \
    libxml2-dev \
    vim && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install -j$(nproc) curl pdo_mysql soap ldap

RUN mkdir /var/www/munkireport

WORKDIR /var/www/munkireport

# Use the github api to find the tarball of the build used in the latest release of munkireport
RUN curl "$(curl -s https://api.github.com/repos/munkireport/munkireport-php/releases/latest | grep "tarball_url" | cut -d '"' -f 4)" --output ./munkireport-php.tar.gz -L
RUN tar -zxf munkireport-php.tar.gz --strip-components=1
RUN rm munkireport-php.tar.gz

RUN mkdir -p app/db && \
    touch app/db/db.sqlite && \
    chmod -R 777 app/db

RUN ln -s /var/www/munkireport/index.php /var/www/html && \
    ln -s /var/www/munkireport/assets /var/www/html && \
    ln -s /var/www/munkireport/.htaccess /var/www/html
    
COPY ./config_default.php /var/www/munkireport/config.php

RUN a2enmod rewrite


EXPOSE 80