#!/bin/bash

# Start MySQL
service mysql start

# Initialize MySQL
mysql -u root << EOF
CREATE DATABASE IF NOT EXISTS mydb;
ALTER USER 'root'@'localhost' IDENTIFIED BY 'rootpassword';
FLUSH PRIVILEGES;
EOF

# Start Apache in foreground
apache2-foreground