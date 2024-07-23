FROM almalinux:8.10

RUN yum -y update && \
	yum install -y mc && \
	yum install -y https://rpms.remirepo.net/enterprise/remi-release-8.rpm && \
	yum install -y yum-utils && \
	yum module reset php && \
	yum module -y install php:remi-8.0 && \
	yum install -y php && \
	yum install -y git && \
	yum install -y zip unzip php-zip
	
RUN	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \ 
	php composer-setup.php && \
	php -r "unlink('composer-setup.php');" && \
	mv composer.phar /usr/local/bin/composer
	
RUN composer require google/apiclient:^2.15.0
	
VOLUME /usr/local/src
COPY ./src /usr/local/src
WORKDIR /usr/local/src

