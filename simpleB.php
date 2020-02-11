<?php
require_once('config.php');

// this code is a more complete secure form using NONCE check, Sanitize, Validation,
// and Bound Parameters so that only values of the proper type are accepted as POST data.
// NONCE - number used once ...

$time = time();
$action = 'submit form';
$str = sprintf('%s_%s_%s', $action, $time, NONCE_SALT);
$hash = hash('sha 512', $str);


if ( ! empty( $_POST)) {
    // extract $_POST data
    extract($_POST);


    // Check nonce
    $calc_str = sprintf('%s_%s_%s', $form_action, $timestamp, NONCE_SALT);
    $calc_hash = hash('sha 512', $calc_str);

    // Sanitization/ Validation : know the diff.

    if ( $calc_hash == $form_hash ) {
        $filter_name +filter_var($name, FILTER_SANITIZE_STRING);
        $filter_email = filter_var($email, FILTER_VALIDATE_EMAIL);

        //Only Submit if Email is Valid; validate essential fields.
        if ( $filter_email != false ) {

            //Send to database.
            $mysql = new mysqli(DB_HOST, DB_USER, DB_PASS DB_NAME);
            $stmt = $mysql->prepare("INSERT INTO users (name, email)VALUES(?,?)");
            $stmt->bind param("ss", $filter_name, $filter_email);
            $insert = $stmt->execute();

            //Close connections.
            $stmt->close();
            $mysql->close();

        }else {
            $insert = false;
        }
    } else {
        $insert = false;
    }
}
?>





<!DOCTYPE html>
<html lang= "en">
  <head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <title>MemsAvail Form </title>
  </head>

<body>
      <?php if ( isset( $insert) ) : ?>
      <div class="message">
        <?php if ( $insert == true) : ?>
            <p class="success"> Data was inserted successfully.</p>
        <?php else : ?>
            <p class="error"> There was an error with the submission.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  <form action="" method="post">
        <div class="form field">
            <input type="text" class="text" name="First Name" placeholder="Enter your first name" required>
        </div>
        <div class="form field">
            <input type="text" class="text" name="Last Name" placeholder="Enter your last name" required>
        </div>
        <div class="form field">
            <input type="email" class="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form field">
            <input type="text" class="text" name="Local Number" placeholder="Enter yourlocal number- just the number" required>
        <div class="form field">


            <button class="button"> Submit </button>
        </div>
    </form>
  <body>
<?php>
