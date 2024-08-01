#!/bin/bash

# Start MySQL
service mariadb start

# Wait for MySQL to be ready
while ! mysqladmin ping -h"localhost" --silent; do
  sleep 1
done

# Create a new database called "picpira"
mysql -u root -ppassword -e "CREATE DATABASE IF NOT EXISTS picpira;"

# Start Apache in foreground
apache2-foreground