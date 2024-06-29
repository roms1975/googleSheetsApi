FROM centos:centos7

RUN yum -y update && \
	yum install -y mc && \
	yum install -y https://rpms.remirepo.net/enterprise/remi-release-7.rpm && \
	yum install -y epel-release && \
	yum install -y yum-utils && \
	yum-config-manager --disable 'remi-php*' && \
	yum-config-manager --enable remi-php82 && \
	yum install -y php && \
	yum install -y git && \
	yum install -y zip unzip php-zip
	
RUN	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \ 
	php composer-setup.php && \
	php -r "unlink('composer-setup.php');" && \
	mv composer.phar /usr/local/bin/composer
	
RUN composer require google/apiclient:^2.15.0
	
WORKDIR /usr/local/src
VOLUME src /usr/local/src

