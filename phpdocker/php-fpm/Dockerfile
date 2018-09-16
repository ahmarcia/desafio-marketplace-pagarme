FROM phpdockerio/php71-fpm:latest
WORKDIR "/var/www"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.1-mysql php7.1-sqlite3 php7.1-bcmath php7.1-gd php7.1-imap php7.1-intl php7.1-phpdbg php7.1-soap php7.1-xmlrpc \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install composer
RUN composer global require hirak/prestissimo --no-interaction \

RUN chmod -R 777 /var/www/logs/
