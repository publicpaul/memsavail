<?php
require_once('config.php');
require_once('countries.php');

// This update to the code includes more field, also adding ...
//NONCE
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
        $filter_frequency = filter_var($frequency, FILTER_SANITIZE_STRING);
        $filter_country = filter_var($country, FILTER_SANITIZE_STRING);
        $filter_comment = filter_var($comment, FILTER_SANITIZE_STRING);

        // FILTER Interests
        foreach (array_keys( $interests ) as $interest ) {
            $filter_interest[] = filter_var($interest, FILTER_SANITIZE_STRING);
         }



        //Only Submit if Email is Valid; validate essential fields.
        if ( $filter_email != false ) {

            //Send to database.
            $mysql= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $stmt = $mysql->prepare("
              INSERT INTO users (name,email,frequency,interests,country,comment)
              VALUES(?,?,?,?,?,?)"
              );
            // parameter (ssssss) specifies six fields to expect.
            // The 's' stands for a string data type. There are 6(six) s's so the
            // database expects 6 values to be returned of 's' format.
            // serialize
            $stmt->bind param("ssssss",
                $filter_name, $filter_email, $filter_frequency,
                serialize($filter interests), $filter_country, $filter_comment
               );

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



<div class=“form’field”>

	//Radio Button titled Frequency with options of Daily or Weekly

	<h3 class=“section-title”>Frequency</h>
	<label for=“frequency-daily”>Daily</label>
	<input type=“radio” class=“radio” id=“frequency-daily” name=“frequency” value=“daily” checked
	<label for=“frequency-weekly”>Weekly</label>
	<input type=“radio” class=“radio” id=“frequency-weekly” name=“frequency” value=“weekly”>

</div>


<div class=“form field”>

	//Checkbox title Interests with options PHP, HTML and/or CSS

	<h3 class=“section-title”>Interests</h>
	<label for=“interests-php”>PHP</label>
	<input type=“checkbox” class=“checkbox” id=“interests-php” name=“interests[php]” value=“1”>
	<label for=“interests-php”>HTML</label>
	<input type=“checkbox” class=“checkbox” id=“interests-html” name=“interests[html]” value=“1”>
	<label for=“interests-php”>CSS</label>
	<input type=“checkbox” class=“checkbox” id=“interests-css” name=“interests[css]” value=“1”>

</div>

//select your Country
// uses foreach loop to roll list of countries in drop down menu

<div class="form-field">
    <h3 class="section-title">Country</h3>
    <select name="country" class="select" required>
        <option value="">Select a Country</option>
        <?php foreach ($countries as $country ) : ?>
            <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
          <?php endforeach; ?>
    </select>
</div>

//leave some comments

<div class=“form-field”>
	<h3 class=“section-title”>Comments</h3>
	<textarea class=“textarea” name=“comment” placeholder=“Enter your comments here”>
</div>
<div class=“form-field”>
	<button class=“button”>Submit</button>]
</div>



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
