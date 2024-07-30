<?php

require 'config.php';
require 'db.php';
require 'helpers.php';

// require all files on folder actions
foreach (glob("actions/*.php") as $filename) {
  require $filename;
}

function api() {
  db_setup();

  // check if the action parameter is set and get it
  if (!isset($_POST['action'])) response_bad_request('Missing action parameter');

  // check if the action function exists
  $action_function_name = 'action_' . $_POST['action'];
  if (!function_exists($action_function_name)) response_not_found('Action not found');

  // call the action function
  $action_function_name();
}

api();
