<?php

function response_error($error_status = 500, $error_message = 'An error occurred') {
  http_response_code($error_status);
  echo json_encode(array('success' => false, 'error' => $error_message));
  exit;
}

function response_not_found($error_message = 'Not found') {
  response_error(404, $error_message);
  exit;
}

function response_bad_request($error_message = 'Bad request') {
  response_error(400, $error_message);
  exit;
}

function response_success($data = null) {
  echo json_encode(array('success' => true, 'data' => $data));
  exit;
}

function generate_password_hash($password) {
  return password_hash($password, PASSWORD_DEFAULT);
}

function verify_password_hash($password, $hash) {
  return password_verify($password, $hash);
}

function generate_auth_token($id) {
  global $SECRET_KEY;
  if (!isset($SECRET_KEY)) throw new Exception('Secret key not set');

  return base64_encode(hash_hmac('sha256', $id, $SECRET_KEY, true));
}

function verify_auth_token($token, $id) {
  global $SECRET_KEY;
  if (!isset($SECRET_KEY)) throw new Exception('Secret key not set');

  return $token === base64_encode(hash_hmac('sha256', $id, $SECRET_KEY, true));
}