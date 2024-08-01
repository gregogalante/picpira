<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

function send_email($to, $subject, $body) {
  global $SMTP_HOST, $SMTP_PORT, $SMTP_USERNAME, $SMTP_PASSWORD, $SMTP_FROM;
  if (!isset($SMTP_HOST)) throw new Exception('SMTP host not set');
  if (!isset($SMTP_PORT)) throw new Exception('SMTP port not set');
  if (!isset($SMTP_USERNAME)) throw new Exception('SMTP username not set');
  if (!isset($SMTP_PASSWORD)) throw new Exception('SMTP password not set');
  if (!isset($SMTP_FROM)) throw new Exception('SMTP from not set');

  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = $SMTP_HOST;
  $mail->SMTPAuth = true;
  $mail->Username = $SMTP_USERNAME;
  $mail->Password = $SMTP_PASSWORD;
  $mail->SMTPSecure = 'tls';
  $mail->Port = $SMTP_PORT;

  $mail->setFrom($SMTP_FROM, 'Picpira');
  $mail->addAddress($to);

  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;

  $mail->send();
  return true;
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