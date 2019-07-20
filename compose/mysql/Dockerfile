FROM mysql:5.6.35

MAINTAINER Puraskar Sapkota <@ems.com>

COPY mysql.cnf /etc/mysql/conf.d/
COPY setup.sql /docker-entrypoint-initdb.d/setup.sql

ARG MYSQL_DATABASE
RUN sed -i -e 's/DATABASE_NAME_TO_BE_REPLACED/'"$MYSQL_DATABASE"'/g' /docker-entrypoint-initdb.d/setup.sql

RUN chmod 777 /docker-entrypoint-initdb.d/setup.sql
RUN usermod -u 1000 mysql && mkdir -p /var/run/mysqld && chmod -R 777 /var/run/mysqld
