<?php
namespace App;
// helper function
// might include this inside Database class

// Validate form data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlentities($data);
  return $data;
}            

/**
 *  Clean up parameters passed into uri
 *
 * @param array $uri
 * @return string
 */
function clean_input(array $uri): string {
  $data = explode('=', $uri['query']);
  $data = explode('+', $data[1]);
  $data = join(' ', $data);
  $data = ucwords(test_input($data));
  return $data;
}