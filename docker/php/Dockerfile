FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive
RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo "UTC" > /etc/timezone
RUN DEBIAN_FRONTEND=noninteractive apt-get update && apt-get upgrade -y && apt-get install -y apt-utils vim curl wget git unzip tzdata
RUN DEBIAN_FRONTEND=noninteractive apt-get update && apt-get install -y php-fpm php-xml php-curl php-zip php-mbstring php-xdebug

ADD etc/php/7.4/fpm/conf.d/ /etc/php/7.4/fpm/conf.d/
ADD etc/php/7.4/cli/conf.d/ /etc/php/7.4/cli/conf.d/
ADD etc/php/7.4/fpm/pool.d/www.conf /etc/php/7.4/fpm/pool.d/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR /home

CMD ["php-fpm7.4", "-F"]
