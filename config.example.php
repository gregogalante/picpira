<?php

// PHP Development settings

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Cache-Control: no-cache, no-store, must-revalidate');

// Title

$TITLE = 'Picpira';

// Version

$VERSION = '1.0.0';

// Directory path

$DIRECTORY_PATH = '/';

// Database Connection

$DB_NAME = 'picpira';
$DB_USER = 'picpira';
$DB_PASSWORD = 'picpira';
$DB_HOST = 'mysql';
$DB_PREFIX = 'picpira_';

// Secret Key

$SECRET_KEY = 'secret';

// SMTP settings

$SMTP_HOST = 'smtp.mailtrap.io';
$SMTP_PORT = 2525;
$SMTP_USERNAME = 'username';
$SMTP_PASSWORD = 'password';
$SMTP_FROM = 'picpira@mail.com';

// Auth data

$AUTH_DATA = array(
  'first_name' => array(
    'required' => true
  ),
  'last_name' => array(
    'required' => true
  ),
  'email' => array(
    'required' => true,
    'username' => true,
    'email' => true
  ),
  'phone' => array(
    'required' => true
  ),
);

// Auth recover password

$AUTH_RECOVER_PASSWORD_WAIT = 60; // seconds until the user can request a new recover password
$AUTH_RECOVER_PASSWORD_EXPIRE = 60 * 60 * 24; // seconds until the recover password token expires

