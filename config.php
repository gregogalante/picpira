<?php

// PHP Error Reporting

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Title

$TITLE = 'Picpira';

// Version

$VERSION = '1.0.0';

// Directory path

$DIRECTORY_PATH = '/picpira/';

// Database Connection

$DB_NAME = 'local';
$DB_USER = 'root';
$DB_PASSWORD = 'root';
$DB_HOST = 'localhost';
$DB_PREFIX = 'picpira_';

$DB_CONNECTION = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

// Secret Key

$SECRET_KEY = 'secret';

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
    'username' => true
  ),
  'phone' => array(
    'required' => true
  ),
);

// Auth recover password

$AUTH_RECOVER_PASSWORD_WAIT = 60; // seconds until the user can request a new recover password
$AUTH_RECOVER_PASSWORD_EXPIRE = 60 * 60 * 24; // seconds until the recover password token expires

