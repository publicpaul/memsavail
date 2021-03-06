<?php
require_once('config.php');

if ( ! empty( $_POST ) ) {
    //Connect and escape... mysqli interface between php and yer sql dbase!
    $link = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $data = array_map( array( $mysql, 'real_escape_string' ), $_POST );
    //Convert to variables. Takes value and converts to string variable. ESCAPED.
    extract( $data );

    //Submit to database
    $query = "INSERT INTO users (first_name,last_name,email,Local_number) VALUES ('$first_name','$last_name','$email','$local_number')";
    $insert = $mysql->query( $query );
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
      <?php if ( isset( $insert ) ) : ?>
      <div class="message">
        <?php if ( $insert == true) : ?>
            <p class="success">Data was inserted successfully.</p>
        <?php else : ?>
            <p class="error">There was an error with the submission.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  <form action="" method="post">
        <div class="form-field">
            <input type="text" class="text" name="First Name" placeholder="Enter your first name" required>
        </div>
        <div class="form-field">
            <input type="text" class="text" name="Last Name" placeholder="Enter your last name" required>
        </div>
        <div class="form-field">
            <input type="email" class="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-field">
            <input type="text" class="text" name="Local Number" placeholder="Enter your local number- just the number" required>
        <div class="form-field">
            <button class="button"> Submit </button>
        </div>
    </form>
  </body>
<?php>
