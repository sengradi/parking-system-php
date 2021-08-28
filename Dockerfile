FROM ubuntu:20.04
MAINTAINER Duy Panharith <hayashimotomori@gmail.com>

WORKDIR /var/www/html
COPY . .

RUN export DEBIAN_FRONTEND=noninteractive && \
        ln -fs /usr/share/zoneinfo/Asia/Phnom_Penh /etc/localtime && \
        apt update && \
        apt install -y tzdata && \
        dpkg-reconfigure --frontend noninteractive tzdata && \
        apt install -y php7.4 php7.4-mysql

EXPOSE 80

CMD apachectl -D FOREGROUND