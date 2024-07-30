<?php

function action_authRecoverPassword() {
  global $AUTH_RECOVER_PASSWORD_WAIT;
  if (!isset($AUTH_RECOVER_PASSWORD_WAIT)) throw new Exception('Auth recover password wait not set');

  if (!isset($_POST['username'])) response_bad_request('Missing username parameter');

  $auth = db_get_auth($_POST['username']);
  if (!$auth) response_error(401, 'Invalid username');

  // take last recover password to be sure that the user is not spamming
  $last_auth_recover_password = db_get_last_auth_recover_password($auth['id']);
  if ($last_auth_recover_password) {
    $last_auth_recover_password_time = strtotime($last_auth_recover_password['created_at']);
    $current_time = time();
    $time_diff = $current_time - $last_auth_recover_password_time;
    if ($time_diff < $AUTH_RECOVER_PASSWORD_WAIT) response_error(429, 'Wait ' . ($AUTH_RECOVER_PASSWORD_WAIT - $time_diff) . ' seconds');
  }

  // generate a new token and store it in the database
  $token = bin2hex(random_bytes(32));
  $created_at = date('Y-m-d H:i:s');
  $auth_revover_password_id = db_create_auth_recover_password($auth['id'], $token, $created_at);
  if (!$auth_revover_password_id) response_error(500, 'Failed to create auth recover password');

  // send email with the token
  // TODO..

  response_success();
}
