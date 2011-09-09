<?php
  // Dependecies
  require_once('shelbyoauth/shelbyoauth.php');
  require_once('config.php');

  // Session
  session_start();

  // Instantiate Shelby Client
  $connection = new ShelbyOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

  // Get user object
  $user = $connection->get('users');
  $channels = $connection->get('channels');
  $broadcasts = $connection->get('channels/'.$channels[1]->_id.'/broadcasts');
?>
Your user:
<hr />
<?print_r($user[0])?>
<br /><br />
Your channels:
<hr />
<?print_r($channels)?>
<br /><br />
Your broadcasts:
<hr />
<?print_r($broadcasts)?>

