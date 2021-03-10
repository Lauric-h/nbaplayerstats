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

