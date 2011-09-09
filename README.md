# Shelby API PHP Client & Boilerplate app
Here is a client for the Shelby API and some boilerplate code to get and app started. You must have created an app at http://dev.shelby.tv for this to work : )

## Configure
Edit config.php

``` php
	<?php
		define('CONSUMER_KEY', 'put your consumer key here');
		define('CONSUMER_SECRET', 'put your consumer secret here');
		define('OAUTH_CALLBACK', 'put your oauth callback (as defined on dev.shelby.tv) here');
	?>
```

## Auth users
From redirect.php:

``` php
	<?php
		/* Start session and load library. */
		session_start();
		require_once('shelbyoauth/shelbyoauth.php');
		require_once('config.php');

		/* Build TwitterOAuth object with client credentials. */
		$connection = new ShelbyOAuth(CONSUMER_KEY, CONSUMER_SECRET);

		/* Get temporary credentials. */
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

		/* Save temporary credentials to session. */
		$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

		/* If last connection failed don't display authorization link. */
		switch ($connection->http_code) {
		  case 200:
		    /* Build authorize URL and redirect user to Twitter. */
		    $url = $connection->getAuthorizeURL($token);
		    header('Location: '.$url); 
		    break;
		  default:
		    /* Show notification if something went wrong. */
		    echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	?>
```

## Get Data
From callback.php

``` php
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
```


#### Author: [Myles Recny](http://www.github.com/mkrecny)