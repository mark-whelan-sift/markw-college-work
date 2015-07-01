<?php
  // This is the function I use to remove all white spaces.
  function remove_space($text) {
    return str_replace(" ", "", $text);
  }

  function validate_pass($error){
    if ($error){
      // Do nothing
    } else {
      // Accept and redirect.
      echo "Processing";
    }
  }
?>
