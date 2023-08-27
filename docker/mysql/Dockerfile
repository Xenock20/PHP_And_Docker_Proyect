FROM mysql:latest

RUN mkdir -p /etc/mysql/conf.d

COPY init.sql /docker-entrypoint-initdb.d/

COPY my.cnf /etc/mysql/my.cnf