<?php

function action_authSignin() {
  if (!isset($_POST['username'])) response_bad_request('Missing username parameter');
  if (!isset($_POST['password'])) response_bad_request('Missing password parameter');

  $auth = db_get_auth($_POST['username']);
  if (!$auth) response_error(401, 'Invalid username or password');

  $auth_valid = verify_password_hash($_POST['password'], $auth['password']);
  if (!$auth_valid) response_error(401, 'Invalid username or password');

  response_success(array(
    'token' => generate_auth_token($auth['id'])
  ));
}
