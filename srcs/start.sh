#!/bin/bash
MYSQL_PWD='guest' mysqld &
service php7.3-fpm start
nginx -g "daemon off;"