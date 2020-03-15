FROM phpdockerio/php71-fpm:latest
WORKDIR "/application"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.1-mysql php7.1-bz2 php7.1-gd php7.1-mbstring php7.1-odbc php7.1-soap \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
    
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip
    RUN curl --silent --show-error https://getcomposer.org/installer | php
