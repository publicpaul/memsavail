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
            <input type="text" class="text" name="First and Last Name" placeholder="Enter your name" required>
        </div>
        <div class="form field">
            <input type="email" class="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form field">
            <input type="float" class="text" name="Union affiliation" placeholder="Enter your local number- just the number" required>
        <div class="form field">
            <button class="button"> Submit </button>
        </div>
      </form>
    <body>
  <?/php>
