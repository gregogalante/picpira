<?php

function action_authSignup() {
  global $AUTH_DATA;
  if (!isset($AUTH_DATA)) throw new Exception('Auth data not set');

  // find the $AUTH_DATA key that has 'username' set to true
  $username_key = array_search(true, array_column($AUTH_DATA, 'username'));
  if (!$username_key) throw new Exception('Username not set');

  // validate required fields
  foreach ($AUTH_DATA as $key => $value) {
    if ($value['required'] && !isset($_POST[$key])) response_bad_request('Missing ' . $key . ' parameter');
  }

  // take username and check if it already exists
  if (!isset($_POST[$username_key])) response_bad_request('Missing ' . $username_key . ' parameter');
  $username = $_POST[$username_key];
  $auth = db_get_auth($username);
  if ($auth) response_error(409, 'Username already exists');

  // take password and create hash
  if (!isset($_POST['password'])) response_bad_request('Missing password parameter');
  $password = generate_password_hash($_POST['password']);

  // create auth
  $auth_id = db_create_auth($username, $password);
  if (!$auth_id) response_error(500, 'Failed to create auth');

  // create auth data
  foreach ($AUTH_DATA as $key => $value) {
    if (isset($_POST[$key])) {
      $auth_data_id = db_create_auth_data($auth_id, $key, $_POST[$key]);
      if (!$auth_data_id) response_error(500, 'Failed to create auth data');
    }
  }

  response_success(array(
    'token' => generate_auth_token($auth_id)
  ));
}