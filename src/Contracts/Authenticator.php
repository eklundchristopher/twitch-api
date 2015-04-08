<?php namespace TwitchApi\Contracts;

interface Authenticator {

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 */
	public function __construct(Application $app);

	/**
	 * Attempt to authenticate the user.
	 *
	 * @return boolean
	 */
	public function authenticate();

	/**
	 * Retrieve the user implementation.
	 *
	 * @return \TwitchApi\Contracts\User
	 */
	public function user();

	/**
	 * Return a Twitch authentication URL.
	 *
	 * @param  string  $client
	 * @param  string  $redirect
	 * @param  string  $scopes
	 * @return string
	 */
	public static function url($client = null, $redirect = null, $scopes = null);

}
