<?php
require_once('load.php');

// This update cleans up the code, using php functions instead of verbose code.
//  Note load.php above, etc. funcs for Sanitization, Validation, nonce, etc.
// Variable names changed to clean up / avoid collisions.


//NONCE
    $timestamp = time();
    $form_action = 'submit form';
    $nonce = create_nonce($form_action, $timestamp);


    if ( ! empty( $_POST)) {
      // extract $_POST data
      insert = process($_POST);
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

  <?php echo do_messages($insert); ?>

  <form action="" method="post">

      // adding hidden fields, timestamp, form_action, nonce...
// FIX DISCREPANCY IN FIELD NAMES, LAST NAME, FIRST NAME, LOCAL AFFIL, ETC.
        <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">
        <input type="hidden" name="form_action" value="<?php echo $form_action; ?>">
        <input type="hidden" name="nonce" value="<?php echo $nonce; ?>">

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



            <button class="button"> Submit </button>
        </div>
    </form>
  <body>
<?php>
