<?php require_once 'vendor/autoload.php';

try {

	$auth = new TwitchApi\Authenticator(new TwitchApi\Application(
		'ly683ybvi9u38339h9mn94ry4mu7sdi',
		'j32e4pptai7uex8qy4vmfdyo1aymegr',
		['user_read', 'user_subscriptions'],
		'http://api.twitch.dev/'
	));

	if (isset($_GET['login']))
	{
		echo '<a href="'.$auth->login().'">Authenticate with Twitch</a>';
		return;
	}

	if ( ! $auth->authenticate())
	{
		throw new Exception;
	}

	/*
	$auth->user->subscribesTo('webdork');

	$auth->user->isPartner();

	$auth->user->avatar();

	$auth->user->displayname();

	$auth->user->name();
	*/

} catch (Exception $e) {

	die($e);

}
