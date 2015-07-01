<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Billing Information</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Poppins:300,400,600' rel='stylesheet' type='text/css'>
  </head>
  <body>

    <?php
      // Start the session
      session_start();
      include 'function.php';
      // Checking if the user has filled in the fields.
      if(isset($_POST['submit'])){
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $card_number = isset($_POST['card_number']) ? $_POST['card_number'] : null;
        $start_month = isset($_POST['start_month']) ? $_POST['start_month'] : null;
        $start_year = isset($_POST['start_year']) ? $_POST['start_year'] : null;
        $end_month = isset($_POST['end_month']) ? $_POST['end_month'] : null;
        $end_year = isset($_POST['end_year']) ? $_POST['end_year'] : null;
        $cvc_code = isset($_POST['cvc_code']) ? $_POST['cvc_code'] : null;
      }

      // Using the function to remove all white space and dashes.
      $card_number = remove_space($card_number);
      $card_number = str_replace("-", "", $card_number);
      // Splitting the card number into an array with four values.
      $card_number = str_split($card_number, 4);
      // Joining the values of the array by a -.
      $correct_card_number = implode("-", $card_number);
      // This variable is for the input box value.
      $value_card_number = implode("", $card_number);


      // Creating an array with all of the numeric fields.
      $numeric_fields = array(
        $_POST['cvc_code'] => 'CVC code',
        $_POST['card_number'] => 'card number',
        $_POST['start_year'] => 'start year',
        $_POST['start_month'] => 'start month',
        $_POST['end_year'] => 'expiration year',
        $_POST['end_month'] => 'expiration month');

      foreach ($numeric_fields as $numeric_field => $human_field) {
        // Checking if they are not numeric.
        if (!is_numeric($numeric_field)) {
          // If not numeric echo...
          echo "The $human_field needs to be numeric <br>";
        }
      }

      // Replacing the old card number with the new one.
      $_POST['card_number'] = $correct_card_number;

      // This is an array of the required fields and human readable values.
      $required_fields = array(
        'name' => 'name',
        'card_number' => 'card number',
        'end_month' => 'expiration month',
        'end_year' => 'expiration year',
        'cvc_code' => 'CVC code');

      // Setting error to false.
      $error = false;
      foreach ($required_fields as $required_field => $human_string) {
        if (empty($_POST[$required_field])) {
          // If empty $error is true and echo empty fields.
          $error = true;
          echo "You must enter your $human_string <br>";
        }
      }

      if ($error){
        // Do nothing
      } else {
        // Accept and redirect.
        echo "Processing";
        //header('Location: successful.php');
      }

    ?>

    <div>
      <header>
        <div>
          <h1>Billing information</h1>
          <h2>indicates required *</h2>
        </div>
      </header>
      <div>
        <h3>Credit / Debit Card</h3>
        <form method="post">
          <label >Name on Card *</label>
          <input type="text" name="name" placeholder="Name on Card *" value="<?php echo $name; ?>"><br>
          <label >Security (CVC) code *</label>
          <input type="text" name="cvc_code" placeholder="CVC *" value="<?php echo $cvc_code; ?>"><br>
          <label >Card Number *</label>
          <input type="text" name="card_number" placeholder="Card Number *" value="<?php echo $value_card_number; ?>"><br>
          <label>Start date</label>
          <input type="text" name="start_month" placeholder="MM" value="<?php echo $start_month; ?>">
          <input type="text" name="start_year" placeholder="YY" value="<?php echo $start_year; ?>"><br>
          <label>End date *</label>
          <input type="text" name="end_month" placeholder="MM *" value="<?php echo $end_month; ?>">
          <input type="text" name="end_year" placeholder="YY *" value="<?php echo $end_year; ?>"><br>
          <button name="submit" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </body>
</html>
