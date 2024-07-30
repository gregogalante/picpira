<?php

function action_authRecoverPasswordUpdate() {
  global $AUTH_RECOVER_PASSWORD_EXPIRE;
  if (!isset($AUTH_RECOVER_PASSWORD_EXPIRE)) throw new Exception('Auth recover password expire not set');

  if (!isset($_POST['username'])) response_bad_request('Missing username parameter');
  if (!isset($_POST['token'])) response_bad_request('Missing token parameter');
  if (!isset($_POST['password'])) response_bad_request('Missing password parameter');

  $auth = db_get_auth($_POST['username']);
  if (!$auth) response_error(401, 'Invalid username');

  $auth_recover_password = db_get_auth_recover_password($auth['id'], $_POST['token']);
  if (!$auth_recover_password) response_error(401, 'Invalid token');

  $created_at = strtotime($auth_recover_password['created_at']);
  $current_time = time();
  $time_diff = $current_time - $created_at;
  if ($time_diff > $AUTH_RECOVER_PASSWORD_EXPIRE) response_error(401, 'Token expired');

  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  db_update_auth_password($auth['id'], $password);

  response_success();
}
