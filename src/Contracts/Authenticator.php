<?php namespace TwitchApi\Contracts;

interface Authenticator {

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 */
	public function __construct(Application $app);

	/**
	 * Return a Twitch authentication link.
	 *
	 * @return string
	 */
	public function login();

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

}
