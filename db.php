<?php

function db_setup() {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  // Create table auth if it doesn't exist with the following columns:
  // id (INT, AUTO_INCREMENT, PRIMARY KEY)
  // username (VARCHAR 255, NOT NULL, UNIQUE)
  // password (VARCHAR 255, NOT NULL)
  $DB_CONNECTION->query('CREATE TABLE IF NOT EXISTS ' . $DB_PREFIX . 'auth (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
  )');

  // Create table auth_data if it doesn't exist with the following columns:
  // id (INT, AUTO_INCREMENT, PRIMARY KEY)
  // auth_id (INT, FOREIGN KEY auth(id))
  // key (VARCHAR 255, NOT NULL)
  // value (TEXT)
  $DB_CONNECTION->query('CREATE TABLE IF NOT EXISTS ' . $DB_PREFIX . 'auth_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auth_id INT,
    FOREIGN KEY (auth_id) REFERENCES ' . $DB_PREFIX . 'auth(id),
    key VARCHAR(255) NOT NULL,
    value TEXT
  )');

  // Create table auth_recover_password if it doesn't exist with the following columns:
  // id (INT, AUTO_INCREMENT, PRIMARY KEY)
  // auth_id (INT, FOREIGN KEY auth(id))
  // token (VARCHAR 255, NOT NULL)
  // created_at (DATETIME, NOT NULL)
  // used_at (DATETIME)
  $DB_CONNECTION->query('CREATE TABLE IF NOT EXISTS ' . $DB_PREFIX . 'auth_recover_password (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auth_id INT,
    FOREIGN KEY (auth_id) REFERENCES ' . $DB_PREFIX . 'auth(id),
    token VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL,
    used_at DATETIME
  )');
}

function db_get_auth($username) {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  $stmt = $DB_CONNECTION->prepare('SELECT * FROM ' . $DB_PREFIX . 'auth WHERE username = ?');
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();

  return $result->fetch_assoc();
}

function db_create_auth($username, $password) {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  $stmt = $DB_CONNECTION->prepare('INSERT INTO ' . $DB_PREFIX . 'auth (username, password) VALUES (?, ?)');
  $stmt->bind_param('ss', $username, $password);
  $stmt->execute();
  $stmt->close();

  return $DB_CONNECTION->insert_id;
}

function db_update_auth_password($auth_id, $password) {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  $stmt = $DB_CONNECTION->prepare('UPDATE ' . $DB_PREFIX . 'auth SET password = ? WHERE id = ?');
  $stmt->bind_param('si', $password, $auth_id);
  $stmt->execute();
  $stmt->close();
}

function db_create_auth_data($auth_id, $key, $value) {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  $stmt = $DB_CONNECTION->prepare('INSERT INTO ' . $DB_PREFIX . 'auth_data (auth_id, key, value) VALUES (?, ?, ?)');
  $stmt->bind_param('iss', $auth_id, $key, $value);
  $stmt->execute();
  $stmt->close();

  return $DB_CONNECTION->insert_id;
}

function db_get_last_auth_recover_password($auth_id) {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  $stmt = $DB_CONNECTION->prepare('SELECT * FROM ' . $DB_PREFIX . 'auth_recover_password WHERE auth_id = ? ORDER BY created_at DESC LIMIT 1');
  stmt->bind_param('s', $auth_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();

  return $result->fetch_assoc();
}

function db_get_auth_recover_password($auth_id, $token) {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  $stmt = $DB_CONNECTION->prepare('SELECT * FROM ' . $DB_PREFIX . 'auth_recover_password WHERE auth_id = ? AND token = ?');
  $stmt->bind_param('is', $auth_id, $token);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();

  return $result->fetch_assoc();
}

function db_create_auth_recover_password($auth_id, $token, $created_at) {
  global $DB_CONNECTION, $DB_PREFIX;
  if (!isset($DB_CONNECTION)) throw new Exception('Database connection not set');
  if (!isset($DB_PREFIX)) throw new Exception('Database prefix not set');

  $stmt = $DB_CONNECTION->prepare('INSERT INTO ' . $DB_PREFIX . 'auth_recover_password (auth_id, token, created_at) VALUES (?, ?, ?)');
  $stmt->bind_param('iss', $auth_id, $token, $created_at);
  $stmt->execute();
  $stmt->close();

  return $DB_CONNECTION->insert_id;
}