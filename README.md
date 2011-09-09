# Shelby API PHP Client & Boilerplate app


## Configure
Edit config.php

``` php
	define('CONSUMER_KEY', 'put your consumer key here');
	define('CONSUMER_SECRET', 'put your consumer secret here');
	define('OAUTH_CALLBACK', 'put your oauth callback (as defined on dev.shelby.tv) here');
```

## Auth users
--From redirect.php---

``` php
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
```

#### Author: [Myles Recny](http://www.github.com/mkrecny)